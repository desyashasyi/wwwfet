<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="px-5 pt-4" />

            {{-- MENU --}}
            <x-menu activate-by-route>
                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />
                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>


                    @role('super-admin')
                        <x-menu-separator />
                        <x-menu-item title="Home" icon="o-sparkles" link="/" />

                        <x-menu-item title="Client" icon="o-archive-box" link="/super-admin/client" />

                    @endrole
                    @role('client')
                        <x-menu-separator />
                        <x-menu-item title="Home" icon="o-sparkles" link="/" />
                        <x-menu-sub title="Basic" icon="o-cog-6-tooth">
                            <x-menu-item title="Institution" icon="o-archive-box" link="####" />
                        </x-menu-sub>
                        <x-menu-item title="Program" icon="o-sparkles" link="/client/program" />
                        <x-menu-sub title="User Management" icon="o-cog-6-tooth">
                            <x-menu-item title="Staff" icon="o-archive-box" link="####" />
                            <x-menu-item title="Program" icon="o-wifi" link="####" />
                            <x-menu-item title="Faculty" icon="o-archive-box" link="####" />
                        </x-menu-sub>
                    @endrole
                    @role('program')
                        <x-menu-separator />
                        <x-menu-item title="Home" icon="o-sparkles" link="/" />
                        <x-menu-sub title="Data" icon="o-cog-6-tooth">
                            <x-menu-item title="Activities" icon="o-archive-box" link="/program/data/activities" />
                            <x-menu-item title="Specialization" icon="o-archive-box" link="/program/data/specialization" />
                            <x-menu-item title="Students" icon="o-archive-box" link="/program/data/students" />
                            <x-menu-item title="Subjects" icon="o-wifi" link="/program/data/subjects" />
                            <x-menu-item title="Teachers" icon="o-archive-box" link="/program/data/teachers" />
                        </x-menu-sub>
                    <x-menu-sub title="Time" icon="o-cog-6-tooth">
                        <x-menu-item title="Activities" icon="o-archive-box" link="/program/time/activities" />
                        <x-menu-item title="Students" icon="o-archive-box" link="/program/time/students" />
                        <x-menu-item title="Teachers" icon="o-archive-box" link="/program/time/teachers" />
                    </x-menu-sub>
                    <x-menu-sub title="Space" icon="o-cog-6-tooth">
                        <x-menu-item title="Teachers" icon="o-archive-box" link="/program/space/teachers" />
                        <x-menu-item title="Students" icon="o-archive-box" link="/program/space/students" />
                        <x-menu-item title="Subjects" icon="o-wifi" link="/program/space/subjects" />
                    </x-menu-sub>
                    <x-menu-sub title="Timetable" icon="o-cog-6-tooth">
                        <x-menu-item title="Simulate" icon="o-archive-box" link="/program/timetable/simulate" />
                        <x-menu-item title="Students" icon="o-archive-box" link="/program/timetable/students" />
                        <x-menu-item title="teachers" icon="o-archive-box" link="/program/timetable/teachers" />
                    </x-menu-sub>
                    @endrole
               @endif

            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
