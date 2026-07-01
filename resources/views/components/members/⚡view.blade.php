<?php

use Livewire\Component;
use App\Models\Membership;

new class extends Component {
    public $member;

    public function mount($xR, $membershipNo)
    {
        $this->member = Membership::where('xR', $xR)->where('membershipNo', $membershipNo)->firstOrFail();
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

            <flux:avatar size="xl" name="{{ $member->GivenName }} {{ $member->FamilyName }}" />

            <div class="flex-1">

                <flux:heading size="lg">
                    {{ $member->GivenName }}
                    {{ $member->MiddleName }}
                    {{ $member->FamilyName }}
                </flux:heading>

                <flux:text>
                    Membership No. {{ $member->membershipNo }}
                </flux:text>

                <div class="mt-4 flex flex-wrap gap-2">

                    <flux:badge size="sm" :color="$member->verified ? 'emerald' : 'orange'">
                        {{ $member->verified ? 'Verified' : 'Unverified' }}
                    </flux:badge>

                    <flux:badge size="sm" :color="$member->uploaded ? 'emerald' : 'zinc'">
                        {{ $member->uploaded ? 'Documents Uploaded' : 'No Documents' }}
                    </flux:badge>

                    <flux:badge size="sm" :color="$member->verified ? 'blue' : 'amber'">
                        {{ $member->verified ? 'Seminar Completed' : 'Seminar Pending' }}
                    </flux:badge>

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
                    <span>{{ $member->GivenName }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Middle Name</span>
                    <span>{{ $member->MiddleName ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Family Name</span>
                    <span>{{ $member->FamilyName }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Gender</span>
                    <span>{{ $member->Gender ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Civil Status</span>
                    <span>{{ $member->CivilStatus ?? '-' }}</span>
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
                    <span>{{ $member->MembershipID }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Membership No.</span>
                    <span>{{ $member->membershipNo }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Date of Membership</span>
                    <span>{{ $member->DateOfMembership }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-zinc-500">Main Membership</span>
                    <span>{{ $member->MainMembershipID ?? '-' }}</span>
                </div>

            </div>

        </flux:card>

        <!-- Address -->
        <flux:card class="lg:col-span-2">

            <flux:heading size="lg">Address</flux:heading>

            <div class="mt-5 grid gap-4 md:grid-cols-3">

                <div>
                    <p class="text-sm text-zinc-500">Street</p>
                    <p>{{ $member->StreetAddress }}</p>
                </div>

                <div>
                    <p class="text-sm text-zinc-500">Barangay</p>
                    <p>{{ $member->BrgyAddress }}</p>
                </div>

                <div>
                    <p class="text-sm text-zinc-500">Municipality</p>
                    <p>{{ $member->TownAddress }}</p>
                </div>

            </div>

        </flux:card>

    </div>

</div>
