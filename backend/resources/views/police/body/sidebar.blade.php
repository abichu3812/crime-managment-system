<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Crime<span style="color: rgb(255, 255, 0);font-size: 20px;">Information</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">

        @php
        $id = Auth::user()->id;
        $profileData =App\Models\User::find($id);
        if($profileData->gender=='male'){
        $gender ='Mr.';
        }elseif($profileData->gender=='female'){
        $gender ='Ms.';
        }
        @endphp

        <ul class="nav">
            <ul class="navbar-nav">

                @php
                $id = Auth::user()->id;
                $profileData =App\Models\User::find($id);
                @endphp
                <li class="nav-item dropdown">

                    <a href="{{route('police.showrecordedcriminal')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users link-icon">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        </svg>
                        <span class="link-title">Recorded Criminal</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('police.showrecordedcriminaldetail')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users link-icon">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        </svg>
                        <span class="link-title">Criminal Details</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('police.showrecordedcriminalfamily')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users link-icon">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        </svg>
                        <span class="link-title">Criminal Family Information</span>
                    </a>
                </li>


    </div>
</nav>