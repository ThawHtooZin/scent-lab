@extends('layouts.storefront')

@section('content')
    <main class="mx-auto w-full max-w-6xl px-4 py-8 md:px-8 md:py-12" x-data="scentMatchWizard()">
        <section data-animate class="relative overflow-hidden rounded-3xl border border-amber-200 bg-gradient-to-br from-amber-50 via-white to-rose-50 p-6 md:p-10">
            <div class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-20 h-56 w-56 rounded-full bg-rose-200/40 blur-3xl"></div>

            <div class="relative">
                <p class="text-[11px] uppercase tracking-[0.16em] text-primary">The Scent Match</p>
                <h1 class="mt-2 text-3xl font-semibold leading-tight text-secondary md:text-5xl">Build your personalized scent identity.</h1>
                <p class="mt-3 max-w-3xl text-sm text-secondary-light md:text-base">
                    A guided step-by-step ritual crafted from your daily rhythm, climate, and social environment.
                </p>
            </div>
        </section>

        <form data-animate method="POST" action="{{ route('scent-match.store') }}" class="mt-8 rounded-3xl border border-stone-200 bg-white p-5 shadow-sm md:p-8">
            @csrf

            <div class="mb-6">
                <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.14em] text-stone-500">
                    <span>Step <span x-text="step"></span> of <span x-text="totalSteps"></span></span>
                    <span><span x-text="totalSteps - step"></span> steps left</span>
                </div>
                <div class="mt-3 grid grid-cols-7 gap-2">
                    <template x-for="index in totalSteps" :key="index">
                        <div class="h-2 rounded-full transition-all duration-500"
                            :class="index < step
                                ? 'bg-primary'
                                : index === step
                                    ? 'bg-gradient-to-r from-amber-500 to-primary'
                                    : 'bg-stone-200'">
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="step === 1" x-transition.opacity.duration.400ms>
                <p class="text-xs uppercase tracking-[0.12em] text-primary">About You</p>
                <h2 class="mt-1 text-2xl font-medium text-secondary">Who should we prepare this profile for?</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm text-stone-600">Name (optional)</span>
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border-stone-200 text-sm focus:border-amber-500 focus:ring-amber-500/40">
                    </label>
                    <label class="block">
                        <span class="text-sm text-stone-600">Email (optional)</span>
                        <input type="email" name="email" value="{{ old('email', session('order_email')) }}" class="mt-1 w-full rounded-xl border-stone-200 text-sm focus:border-amber-500 focus:ring-amber-500/40">
                    </label>
                </div>
            </div>

            <div x-show="step === 2" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">Where do you spend most of your day?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="daily_environment" value="office" required><span>Office / AC</span></label>
                    <label class="match-option"><input type="radio" name="daily_environment" value="outdoors" required><span>Outdoors / Heat</span></label>
                    <label class="match-option"><input type="radio" name="daily_environment" value="hybrid" required><span>Hybrid Routine</span></label>
                </div>
            </div>

            <div x-show="step === 3" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">What energy do you want to radiate today?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="energy_style" value="grounded" required><span>Grounded & composed</span></label>
                    <label class="match-option"><input type="radio" name="energy_style" value="balanced" required><span>Balanced & polished</span></label>
                    <label class="match-option"><input type="radio" name="energy_style" value="high" required><span>High-energy & bright</span></label>
                </div>
            </div>

            <div x-show="step === 4" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">How do you want people to remember your scent?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="scent_impression" value="clean" required><span>Clean & subtle</span></label>
                    <label class="match-option"><input type="radio" name="scent_impression" value="bold" required><span>Bold & magnetic</span></label>
                    <label class="match-option"><input type="radio" name="scent_impression" value="approachable" required><span>Warm & approachable</span></label>
                </div>
            </div>

            <div x-show="step === 5" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">What climate are you navigating most?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="climate_profile" value="cool" required><span>Dry / Cool</span></label>
                    <label class="match-option"><input type="radio" name="climate_profile" value="humid" required><span>Hot / Humid</span></label>
                    <label class="match-option"><input type="radio" name="climate_profile" value="windy" required><span>Windy / Open</span></label>
                </div>
            </div>

            <div x-show="step === 6" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">How social is your day?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="social_density" value="solo" required><span>Mostly solo</span></label>
                    <label class="match-option"><input type="radio" name="social_density" value="small" required><span>Small groups</span></label>
                    <label class="match-option"><input type="radio" name="social_density" value="crowded" required><span>Crowded spaces</span></label>
                </div>
            </div>

            <div x-show="step === 7" x-transition.opacity.duration.400ms>
                <h2 class="text-2xl font-medium text-secondary">Which longevity pattern fits your routine?</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <label class="match-option"><input type="radio" name="longevity_goal" value="soft" required><span>Soft all day trail</span></label>
                    <label class="match-option"><input type="radio" name="longevity_goal" value="long" required><span>Long, vivid projection</span></label>
                    <label class="match-option"><input type="radio" name="longevity_goal" value="all_day" required><span>Adaptive all-day balance</span></label>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <button type="button" @click="prev()" x-show="step > 1" class="rounded-xl border border-stone-300 px-4 py-2 text-xs uppercase tracking-[0.12em] text-stone-700 transition hover:border-stone-400">
                    Back
                </button>
                <span x-show="step === 1"></span>

                <button type="button" @click="next()" x-show="step < totalSteps" class="rounded-xl bg-amber-700 px-5 py-2.5 text-xs uppercase tracking-[0.14em] text-white transition hover:bg-amber-800">
                    Continue
                </button>

                <button type="submit" x-show="step === totalSteps" class="rounded-xl bg-secondary px-5 py-2.5 text-xs uppercase tracking-[0.14em] text-white transition hover:bg-secondary-dark">
                    Reveal My Match
                </button>
            </div>
        </form>

        @if ($errors->any())
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif
    </main>

    <script>
        function scentMatchWizard() {
            return {
                step: 1,
                totalSteps: 7,
                next() {
                    if (this.step < this.totalSteps) this.step++;
                },
                prev() {
                    if (this.step > 1) this.step--;
                },
            };
        }
    </script>
@endsection
