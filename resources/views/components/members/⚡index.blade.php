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

    public function with(): array
    {

        $towns = Town::orderBy('TownName', 'asc')->get();

        $members = Membership::query()
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
};
?>

<div class="space-y-4">
    <div>
        <flux:heading size="xl">Members</flux:heading>
        <flux:text>Manage members</flux:text>
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
            <flux:table.column>Membership ID</flux:table.column>
            <flux:table.column>Membership No</flux:table.column>
            {{-- <flux:table.column>OR Number</flux:table.column> --}}
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($members as $member)
                <flux:table.row>
                        <flux:table.cell>{{ $member->GivenName }} {{ $member->MiddleName }} {{ $member->FamilyName }} {{ $member->subName }}</flux:table.cell>
                        <flux:table.cell>
                            {{ $member->BrgyAddress }},
                            {{ $member->TownAddress }}
                        </flux:table.cell>
                        <flux:table.cell>{{ $member->MembershipID }}</flux:table.cell>
                        <flux:table.cell>{{ $member->membershipNo }}</flux:table.cell>
                        {{-- <flux:table.cell>{{ $member->ORNumber }}</flux:table.cell> --}}
                    </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4" class="text-center py-5 text-gray-500">
                        No Data Found
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
        

    </flux:table>

</div>