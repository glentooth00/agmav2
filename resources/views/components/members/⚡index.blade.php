<?php

use App\Models\Membership;
use App\Models\Accounts;
use App\Models\Attendees;
use App\Models\Town;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\flux;

new class extends Component
{
    use WithPagination;

    public string $district = '';
    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';
    public string $suffixname = '';
    public string $membership_id = '';
    public string $membership_no = '';


    public function updatedGivenName()
    {
        $this->resetPage();
    }

    public function updatedMiddleName()
    {
        $this->resetPage();
    }

    public function updatedLastName()
    {
        $this->resetPage();
    }

    public function updatedTown()
    {
        $this->resetPage();
    }

    public function updateSubname(){
        $this->resetPage();
    }

    public function getConnection($xR, $membershipNo){
        
        $getConnection = Accounts::where('MembershipID', $xR)->where('ORNumber', $membershipNo)->firstOrFail();
        $getMembership = Membership::where('xR', $xR)->where('membershipNo', $membershipNo)->firstOrFail();

        $consumerData = [
            'membership_id' => $getConnection['MembershipID'],
            'membership_no' => $getConnection['ORNumber'],
            'account_number' => $getConnection['AccountNumber'],
            'firstName' => $getMembership['GivenName'],
            'middleName' => $getMembership['MiddleName'],
            'lastName' => $getMembership['lastname'],
            'suffix' => $getMembership['subName'],
            'registration_type' => 'Walk-in',
            'street' => $getMembership['StreetAddress'],
            'barangay' => $getMembership['BrgyAddress'],
            'municipality' => $getMembership['TownAddress'],
            'membership_type' => $getMembership['member_Type'],
            'gender' => $getMembership['Gender'],
        ];

        attendees::create($consumerData);

        Flux::toast(
            heading: 'Success',
            text: 'Member registered successfully.',
            variant: 'success',
        );


    }

    public function with(): array
    {
        $towns = Town::orderBy('TownName', 'asc')->get();

        $members = Membership::query()
            ->where(function ($query) {
                $query->where(function ($query) {
                    // Juridical members
                    $query->where('is_juridical', '1')
                        ->whereNotNull('firstname')
                        ->where('firstname', '<>', '');
                })
                ->orWhere(function ($query) {
                    // Regular members
                    $query->whereNotNull('firstname')
                        ->where('firstname', '<>', '')
                        ->whereNotNull('middleName')
                        ->where('middleName', '<>', '')
                        ->whereNotNull('lastname')
                        ->where('lastname', '<>', '');
                });
            })
            ->when($this->firstname, function ($query) {
                $query->where('firstname', 'LIKE', "%{$this->firstname}%");
            })
            ->when($this->middlename, function ($query) {
                $query->where('middleName', 'LIKE', "%{$this->middlename}%");
            })
            ->when($this->lastname, function ($query) {
                $query->where('lastname', 'LIKE', "%{$this->lastname}%");
            })
            ->when($this->district, function ($query) {
                $query->where('district', 'LIKE', "%{$this->district}%");
            })
            ->when($this->suffixname, function ($query) {
                $query->where('suffixname', 'LIKE', "%{$this->suffixname}%");
            })
            ->paginate(10);

        return [
            'members' => $members,
            'towns' => $towns,
        ];
    }

    public function checkRegistration($membership_id, $membership_no){

        $checkRegistration = Attendees::where('membership_id', $membership_id)->where('membership_no', $membership_no)->first();
        
        if($checkRegistration){
            
            Flux::toast(
                heading: 'warning',
                text: 'Member already registered.',
                variant: 'warning',
                );

        }else{

            $this->getConnection($membership_id, $membership_no);
        }
        
    }


};
?>

<div class="space-y-4">
    <div class="">
        <flux:heading size="xl">Members</flux:heading>
        <flux:text class="mb-2">Manage members</flux:text>
        <flux:separator />
    </div>
    <div class="flex items-center gap-3">
    <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="firstname"
            icon="magnifying-glass"
            placeholder="Firstname"
        />
    </flux:field>
    <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="middlename"
            icon="magnifying-glass"
            placeholder="Middle Name"
        />
    </flux:field>

    <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="lastname"
            icon="magnifying-glass"
            placeholder="Last Name"
        />
    </flux:field>
        <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="suffixname"
            icon="magnifying-glass"
            placeholder="Suffix (e.g Jr, Sr, I, II, III)"
        />
    </flux:field>
    <flux:field class="w-64">
        <flux:select wire:model.live.debounce.300ms="district" placeholder="Select town">
            @foreach ($towns as $town)
                <flux:select.option>{{ $town->TownName }}</flux:select.option>
            @endforeach
        </flux:select>
    </flux:field>
</div>
    <flux:table :paginate="$members" sticky class="table-stripped">
        <flux:table.columns>
            <flux:table.column>Member Name</flux:table.column>
            <flux:table.column>Address</flux:table.column>
            <flux:table.column>Membership Type</flux:table.column>
            <flux:table.column>Co-Member</flux:table.column>
            <flux:table.column>Membership No</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($members as $member)
                <flux:table.row>
                        <flux:table.cell>
                            <flux:text variant="strong" class="text-gray-600">
                                <b>{{ $member->firstname }} {{ $member->middlename ?? '' }} {{ $member->lastname ?? null }} {{ $member->suffixname ?? null}}</b>
                            </flux:text>    
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $member->street }}
                            {{ $member->brgy }},
                            {{ $member->district }}
                        </flux:table.cell>
                        <flux:table.cell>
                            @php
                                $memberType = strtoupper(trim($member->member_type ?? ''));
                                $isJuridical = strtoupper(trim((string) ($member->is_juridical ?? '0')));
                            @endphp

                            @switch (true)
                                @case ($isJuridical === '1' || $isJuridical === 'YES' || $memberType === 'JURIDICAL')
                                    <flux:badge size="sm" color="purple">Juridical</flux:badge>
                                    @break

                                @case ($memberType === 'SINGLE')
                                    <flux:badge size="sm" color="green">SINGLE</flux:badge>
                                    @break

                                @case ($memberType === 'JOINT')
                                    <flux:badge size="sm" color="blue">JOINT</flux:badge>
                                    @break
                            @endswitch
                        </flux:table.cell>
                        <flux:table.cell>
                            @php
                                $memberType = strtoupper(trim($member->member_type ?? ''));
                                $isJuridical = strtoupper(trim((string) ($member->is_juridical ?? '0')));
                            @endphp

                            @switch (true)
                                @case ($isJuridical === '1' || $isJuridical === 'YES' || $memberType === 'JURIDICAL')
                                    <flux:badge size="sm" color="">--</flux:badge>
                                    @break

                                @case ($memberType === 'SINGLE')
                                    <flux:badge size="sm" color="">--</flux:badge>
                                    @break

                                @case ($memberType === 'JOINT')
                                    <flux:text color="blue" variant="strong">
                                        <b>{{ $member->secondary_firstname }} {{ $member->secondary_middlename ?? '' }} {{ $member->secondary_lastname ?? null }} {{ $member->secondary_suffixname ?? null}}</b>
                                    </flux:text>
                                    @break
                            @endswitch
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="zinc" size="sm" variant="subtle" style="letter-spacing:2px;">{{ $member->membership_no ?? '--' }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button
                                icon="eye"
                                color="cyan"
                                variant="primary"
                                size="sm"
                                href="{{ route('members.view', [
                                    'membership_id' => $member->membership_id,
                                    'membership_no' => $member->membership_no,
                                ]) }}"
                                >
                                View
                            </flux:button>
                            <flux:button 
                                icon="plus-circle"
                                color="blue"
                                variant="primary"
                                size="sm"
                                class="cursor-pointer"
                                wire:click="checkRegistration('{{ $member->membership_id }}', '{{ $member->membership_no }}')"
                                confirm="Are you sure you want to register this member?"
                                >
                                Register
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4" class="text-center py-4 text-gray-500">
                        No Data Found
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>