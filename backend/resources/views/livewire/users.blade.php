@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-2">



<div style="background-color:rgb(60, 87, 145)" class="max-w-6xl mx-auto my-16 px-4">

<form 
        action="{{ 
            $profileData->role == 'admin' ? route('admin.dashboard') : 
            ($profileData->role == 'collage_registral' ? route('collageregistral.dashboard') : 
            ($profileData->role == 'collage_dean' ? route('collagedean.dashboard') : 
            ($profileData->role == 'investigator' ? route('departmenthead.dashboard') : 
            ($profileData->role == 'stuff' ? route('stuff.dashboard') : '#'))))
        }}" 
        method="get"
        class="w-full sm:w-auto"
    >
        <button 
            style="font-size:20px; font-weight:bold; border-color: green;" 
            type="submit" 
            class="btn btn-outline-success inline-flex justify-center items-center gap-x-2 text-sm lg:text-lg font-medium px-4 lg:px-8 py-2 lg:py-3 border border-green-500 text-green-600 bg-gradient-to-r from-green-100 to-white shadow-md hover:from-green-200 hover:to-green-100 hover:text-green-700 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105"
            aria-label="Add users to my Chatlist"
        >
            HOME
        </button>
    </form>

    <h5 class="text-center text-3xl md:text-5xl font-bold py-3 text-white">Users</h5>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 p-2">
        @foreach ($users as $key => $user)
        <div class="w-full bg-white border border-gray-200 rounded-lg p-5 shadow hover:shadow-lg transition-shadow duration-300">
            <div class="flex flex-col items-center pb-10">
            <div style="position: relative; display: inline-block;">
    <img class="wd-40 ht-40 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_image/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
    @if(empty($profileData->photo))
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; pointer-events: none; text-transform: uppercase;">
        {{ substr($profileData->name, 0, 1) }}
    </div>
    @endif
</div>                <h5 class="mb-1 text-xl font-medium text-gray-900">
                    {{$user->name}}
                </h5>
                <span class="text-sm text-gray-500">{{$user->email}}</span>
                <div class="flex mt-4 space-x-3">
                    <x-secondary-button>
                        Add Friend
                    </x-secondary-button>
                    <x-primary-button wire:click="message({{$user->id}})">
                        Message
                    </x-primary-button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>