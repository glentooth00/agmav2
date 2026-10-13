<?php

use Livewire\Component;
use App\Models\customerDetails;
use App\Models\Membership;

new class extends Component {
    public $member;
    public $membership_id;

    public function mount($membership_id, $membership_no = null)
    {
        $this->member = Membership::where('membership_id', $membership_id)->where('membership_no', $membership_no ?? null)->firstOrFail();
    }

    public function render()
    {
        $membership_id = $this->member->membership_id;

        $electricAccounts = customerDetails::where('tracking_number', $membership_id)
                                            ->where('c_status', 'ACTV')
                                            ->paginate(5);

        return view('components.members.⚡view', [
            'member' => $this->member,
            'electricAccounts' => $electricAccounts
        ]);
    }

};
?>

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">MCO Details</flux:heading>
            <flux:text>Member Profile</flux:text>
        </div>

        <flux:button icon="arrow-left" variant="ghost" :href="route('members.index')">
            Back
        </flux:button>

    </div>

    <flux:separator class="mt-1" />

    <!-- Profile Header -->
    <flux:card>
        <div class="flex flex-col gap-6 md:flex-row md:items-center">

            <flux:avatar size="xl" name="{{ $member->firstname }} {{ $member->lastname }}" />

            <div class="flex-1">

                <flux:heading size="lg">
                    {{ $member->firstname }}
                    {{ $member->middlename }}
                    {{ $member->lastname }}
                </flux:heading>

                <flux:text>
                    Membership No. {{ $member->membership_no }}
                </flux:text>

                <div class="mt-4 flex flex-wrap gap-2">

                    {{-- <flux:badge size="sm" :color="$member->verified ? 'emerald' : 'orange'">
                        {{ $member->verified ? 'Verified' : 'Unverified' }}
                    </flux:badge>

                    <flux:badge size="sm" :color="$member->uploaded ? 'emerald' : 'zinc'">
                        {{ $member->uploaded ? 'Documents Uploaded' : 'No Documents' }}
                    </flux:badge>

                    <flux:badge size="sm" :color="$member->verified ? 'blue' : 'amber'">
                        {{ $member->verified ? 'Seminar Completed' : 'Seminar Pending' }}
                    </flux:badge> --}}

                </div>

            </div>

        </div>
    </flux:card>

    <div class="grid gap-6 lg:grid-cols-2">

        <!-- Personal Information -->
        <flux:card>
            <flux:heading size="lg">Personal Information</flux:heading>

            <div class="mt-5 space-y-3">

                <div class="flex justify-between">
                    <span class="text-zinc-500">Given Name</span>
                    <span>{{ $member->firstname }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Middle Name</span>
                    <span>{{ $member->middlename ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Family Name</span>
                    <span>{{ $member->lastname }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Gender</span>
                    <span>{{ $member->gender ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Civil Status</span>
                    <span>{{ $member->civil_status ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Birth Date</span>
                    <span>{{ $member->BirthDate ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Contact No.</span>
                    <span>{{ $member->ContactNo ?? '-' }}</span>
                </div>

            </div>

        </flux:card>

        <!-- Membership -->
        <flux:card>

            <flux:heading size="lg">Membership Information</flux:heading>

            <div class="mt-5 space-y-3">

                <div class="flex justify-between">
                    <span class="text-zinc-500">Membership ID</span>
                    <span>{{ $member->membership_id }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Membership No.</span>
                    <span>{{ $member->membership_no }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Date of Membership</span>
                    <span>{{ $member->date_of_membership }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Main Membership</span>
                    <span>{{ $member->main_membership_id ?? '-' }}</span>
                </div>

                @if ($member->member_type === 'JOINT')
                    <div class="flex justify-between">
                        <span class="text-zinc-500">Co-Member</span>
                        <span>{{ $member->secondary_firstname }} {{ $member->secondary_middlename ?? '' }} {{ $member->secondary_lastname ?? null }} {{ $member->secondary_suffixname ?? null}}</span>
                    </div>
                @endif

            </div>

        </flux:card>

        <!-- Electric accounts -->
        <flux:card class="lg:col-span-2">

            <flux:heading size="lg">Electric Accounts</flux:heading>

            <div class="mt-5 overflow-x-auto">
                <flux:table :paginate="$electricAccounts" sticky class="table-stripped">
                    <flux:table.columns>
                        <flux:table.column>Account Number</flux:table.column>
                        <flux:table.column>Address</flux:table.column>
                        <flux:table.column>Type</flux:table.column>
                        <flux:table.column>Status</flux:table.column>
                        <flux:table.column>Description</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        {{-- Replace $member->electricAccounts with your actual relationship --}}
                        @forelse ($electricAccounts as $electricAccount)
                            <flux:table.row>
                                <flux:table.cell>
                                    {{ $electricAccount->c_id }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    {{ $electricAccount->address }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    {{ $electricAccount->type }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    <flux:badge
                                        size="sm"
                                        color="{{ strtolower($electricAccount->status) === 'active' ? 'red' : 'green' }}"
                                    >
                                        {{ $electricAccount->c_status }}
                                    </flux:badge>
                                </flux:table.cell>
                                <flux:table.cell>
                                    @switch (strtoupper(trim($electricAccount->r_description ?? '')))
                                        @case('RESIDENTIAL')
                                            <flux:badge size="sm" color="green">
                                                RESIDENTIAL
                                            </flux:badge>
                                            @break

                                        @case('STREET LIGHTS LOW VOLTAGE')
                                            <flux:badge size="sm" color="yellow">
                                                STREET LIGHTS LOW VOLTAGE
                                            </flux:badge>
                                            @break

                                        @case('COMMERCIAL HIGH VOLTAGE')
                                            <flux:badge size="sm" color="red">
                                                COMMERCIAL HIGH VOLTAGE
                                            </flux:badge>
                                            @break

                                        @case('COMMERCIAL LOW VOLTAGE')
                                            <flux:badge size="sm" color="blue">
                                                COMMERCIAL LOW VOLTAGE
                                            </flux:badge>
                                            @break

                                        @default
                                            <flux:badge size="sm" color="zinc">
                                                {{ $electricAccount->r_description ?: '—' }}
                                            </flux:badge>
                                    @endswitch
                                </flux:table.cell>
                            </flux:table.row>
                        @empty
                            <flux:table.row>
                                <flux:table.cell colspan="5">
                                    <div class="py-6 text-center text-sm text-zinc-500">
                                        No electric accounts found.
                                    </div>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforelse
                    </flux:table.rows>
                </flux:table>
            </div>

        </flux:card>

    </div>

</div>
