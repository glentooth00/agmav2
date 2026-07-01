<?php

use App\Models\Membership;
use App\Models\Town;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $town = '';
    public string $givenName = '';
    public string $middleName = '';
    public string $familyName = '';
    public string $subName = '';


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
        
        $getMember = Membership::where('xR', $xR)->where('membershipNo', $membershipNo)->firstOrFail();

    }

    public function with(): array
    {

        $towns = Town::orderBy('TownName', 'asc')->get();

        $members = Membership::query()
            // Ensure all three name fields are neither NULL nor empty strings
            ->whereNotNull('GivenName')->where('GivenName', '<>', '')
            ->whereNotNull('MiddleName')->where('MiddleName', '<>', '')
            ->whereNotNull('FamilyName')->where('FamilyName', '<>', '')
            ->when( $this->givenName, function($query){
                $query->where('GivenName', 'LIKE', "%{$this->givenName}%");
            })
            ->when( $this->givenName, function($query){
                $query->where('MiddleName', 'LIKE' , "%{$this->middleName}%");
            })
            ->when( $this->familyName, function($query){
                $query->where('FamilyName', 'LIKE', "%{$this->familyName}%");
            })
            ->when( $this->town, function ($query){
                $query->where('TownAddress', 'LIKE' , "%{$this->town}%");
            })
            ->when( $this->town, function ($query){
                $query->where('subName', 'LIKE', "%{$this->subName}%");
            })->paginate(10);

        return [
            'members' => $members,
            'towns'   => $towns
        ];
    }

    public function save($xR, $membershipNo)
    {
        dd($xR, $membershipNo);
        // $member = Membership::where('xR', $xR)->where('membershipNo', $membershipNo)->firstOrFail();
        // $member->registered = 'True';
        // $member->save();

        // session()->flash('message', 'Member registered successfully.');

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
    <flux:field class="w-32">
        <flux:input
            wire:model.live.debounce.300ms="givenName"
            icon="magnifying-glass"
            placeholder="Given Name"
        />
    </flux:field>
    <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="middleName"
            icon="magnifying-glass"
            placeholder="Middle Name"
        />
    </flux:field>

    <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="lastName"
            icon="magnifying-glass"
            placeholder="Last Name"
        />
    </flux:field>
        <flux:field class="w-64">
        <flux:input
            wire:model.live.debounce.300ms="subName"
            icon="magnifying-glass"
            placeholder="Suffix (e.g Jr, Sr, I, II, III)"
        />
    </flux:field>
    <flux:field class="w-64">
        <flux:select wire:model.live.debounce.300ms="town" placeholder="Select town">
            @foreach ($towns as $town)
                <flux:select.option>{{ $town->TownName }}</flux:select.option>
            @endforeach
        </flux:select>
    </flux:field>
</div>
    <flux:table :paginate="$members" sticky>
        <flux:table.columns>
            <flux:table.column>Member Name</flux:table.column>
            <flux:table.column>Address</flux:table.column>
            <flux:table.column>Verification</flux:table.column>
            <flux:table.column>Membership No</flux:table.column>
            <flux:table.column>Membership Type</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($members as $member)
                <flux:table.row>
                        <flux:table.cell>{{ $member->GivenName ?? 'null' }} {{ $member->MiddleName ?? 'null' }} {{ $member->FamilyName ?? null }} {{ $member->subName ?? null}}</flux:table.cell>
                        <flux:table.cell>
                            {{ $member->BrgyAddress }},
                            {{ $member->TownAddress }}
                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($member->member_Type === 'Member')
                                @if ($member->verified === 'True')
                                    <flux:badge size="sm" color="lime">Verified</flux:badge>
                                @else
                                    <flux:badge size="sm" color="orange">Unverified</flux:badge>
                                @endif
                            @elseif ($member->member_Type === 'Co-member')
                                @if ($member->verified === 'False')
                                    <flux:badge size="sm" color="lime">Verified</flux:badge>
                                @endif
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="zinc" size="sm" variant="subtle" style="letter-spacing:2px;">{{ $member->membershipNo ?? '----' }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($member->member_Type === 'Member')
                                <flux:badge size="sm" color="green">Member</flux:badge>
                            @elseif ($member->member_Type === 'Co-member')
                                <flux:badge size="sm" color="blue">Co-Member</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button 
                                icon="eye"
                                color="emerald"
                                variant="filled"
                                size="sm"
                                class="cursor-pointer"
                                href="{{ route('members.view', [
                                        'xR' => $member->xR,
                                        'membershipNo' => $member->membershipNo,
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
                                wire:click="save('{{ $member->xR }}', '{{ $member->membershipNo }}')"
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