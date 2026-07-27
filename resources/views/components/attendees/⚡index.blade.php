<?php

use Livewire\Component;
use App\Models\Town;
use App\Models\Attendees;

new class extends Component
{
    public string $town = '';
    public string $givenName = '';
    public string $middleName = '';
    public string $familyName = '';
    public string $subName = '';

    public function render()
    {
        $towns = Town::orderBy('TownName', 'asc')->get();

        $totalAttendees = Attendees::count();

        $members = Attendees::query()
            // Ensure all three name fields are neither NULL nor empty strings
            ->whereNotNull('firstName')->where('firstName', '<>', '')
            ->whereNotNull('middleName')->where('middleName', '<>', '')
            ->whereNotNull('lastname')->where('lastname', '<>', '')
            ->when( $this->givenName, function($query){
                $query->where('firstName', 'LIKE', "%{$this->givenName}%");
            })
            ->when( $this->middleName, function($query){
                $query->where('middleName', 'LIKE' , "%{$this->middleName}%");
            })
            ->when( $this->familyName, function($query){
                $query->where('lastname', 'LIKE', "%{$this->familyName}%");
            })
            ->when( $this->town, function ($query){
                $query->where('municipality', 'LIKE' , "%{$this->town}%");
            })
            ->when( $this->subName, function ($query){
                $query->where('subName', 'LIKE', "%{$this->subName}%");
            })->paginate(10);

        return view('components.attendees.⚡index',[
            'towns' => $towns,
            'members' => $members,
            'totalAttendees' => $totalAttendees,
        ]);
    }
};

?>

<div class="space-y-4">
    <div class="">
        <flux:heading size="xl">Attendees</flux:heading>
        <flux:text class="mb-2">Attended MCO`s</flux:text>
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
            wire:model.live.debounce.300ms="familyName"
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
    <flux:table :paginate="$members" sticky class="table-stripped">
        <flux:table.columns>
            <flux:table.column>Member Name</flux:table.column>
            <flux:table.column>Address</flux:table.column>
            <flux:table.column>Registration Type</flux:table.column>
            <flux:table.column>Membership No</flux:table.column>
            <flux:table.column>Membership Type</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($members as $member)
                <flux:table.row>
                        <flux:table.cell>{{ $member->firstname ?? 'null' }} {{ $member->middlename ?? 'null' }} {{ $member->lastname ?? null }} {{ $member->suffix ?? null}}</flux:table.cell>
                        <flux:table.cell>
                            {{ $member->street ?? 'null' }},
                            {{ $member->barangay ?? 'null' }},
                            {{ $member->municipality ?? 'null' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="lime" size="sm">{{ $member->registration_type }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="zinc" size="sm" variant="subtle" style="letter-spacing:2px;">{{ $member->membership_no ?? '--' }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($member->membership_type === 'Member')
                                <flux:badge size="sm" color="green">Member</flux:badge>
                            @elseif ($member->membership_type === 'Co-member')
                                <flux:badge size="sm" color="blue">Co-Member</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button 
                                icon="eye"
                                color="cyan"
                                variant="primary"
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
                                wire:click="checkRegistration('{{ $member->xR }}', '{{ $member->membershipNo }}')"
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

