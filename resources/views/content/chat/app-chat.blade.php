
@extends('layouts/contentLayoutMaster')

@section('title', 'Chat Application')

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat-list.css')) }}">
@endsection

@include('content/chat/app-chat-sidebar')

@section('content')
<div class="body-content-overlay"></div>
<!-- Main chat area -->
<section class="chat-app-window">
  <!-- To load Conversation -->
  <div class="start-chat-area">
    <div class="mb-1 start-chat-icon">
      <i data-feather="message-square"></i>
    </div>
    <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
  </div>
  <!--/ To load Conversation -->

  <!-- Active Chat -->
  <div class="active-chat d-none">
    <!-- Chat Header -->
    <div class="chat-navbar" id = "chatbox">
      <header class="chat-header">
        <div class="d-flex align-items-center">
          <div class="sidebar-toggle d-block d-lg-none mr-1">
            <i data-feather="menu" class="font-medium-5"></i>
          </div>
          <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
            <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="36" width="36" />
            <span class="avatar-status-busy"></span>
          </div>
          <h6 class="mb-0">Kristopher Candy</h6>
        </div>
        <div class="d-flex align-items-center">
          <i data-feather="phone-call" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
          <i data-feather="video" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
          <i data-feather="search" class="cursor-pointer d-sm-block d-none font-medium-2"></i>
          <div class="dropdown">
            <button
              class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle"
              type="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i data-feather="more-vertical" id="chat-header-actions" class="font-medium-2"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions">
              <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
              <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
              <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
              <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
              <a class="dropdown-item" href="javascript:void(0);">Report</a>
            </div>
          </div>
        </div>
      </header>
    </div>
    <!--/ Chat Header -->

    <!-- User Chat messages -->
    @foreach ($employees as $employe)
    @foreach ($chat as $cht)
@if ($employe->id==$cht->to)
    <div class="user-chats">
      <div class="chats">
        <div class="chat">
          <div class="chat-avatar">
            <span class="avatar box-shadow-1 cursor-pointer">
              <img
              src="{{asset('images/profiles/'.auth()->user()->profile_picture)}}"
                alt="avatar"
                height="36"
                width="36"
              />
            </span>
          </div>
          <div class="chat-body">
            <div class="chat-content">
              <p>{{$cht->messages}}</p>
            </div>
          </div>
        </div>
       @if (Auth::user()->id==$cht->to)
        <div class="chat chat-left">
          <div class="chat-avatar">
            <span class="avatar box-shadow-1 cursor-pointer">
              <img  src="{{asset('images/profiles/'.$employe->profile_picture)}}" alt="avatar" height="36" width="36" />
            </span>
          </div>
          <div class="chat-body">
            <div class="chat-content">
              <p>{{$cht->messages}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @endif
    @endforeach
    @endforeach
    <!-- User Chat messages -->

    <!-- Submit Chat form -->
    <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
      <div class="input-group input-group-merge mr-1 form-send-message">
        <div class="input-group-prepend">
          <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
        </div>
        <input type="text" class="form-control message" placeholder="Type your message or use speech to text" />
      </div>
      <button type="button" class="btn btn-primary send" onclick="enterChat();">
        <i data-feather="send" class="d-lg-none"></i>
        <span class="d-none d-lg-block">Send</span>
      </button>
    </form>
    <!--/ Submit Chat form -->
  </div>
  <!--/ Active Chat -->
</section>
<!--/ Main chat area -->

<!-- User Chat profile right area -->
<div class="user-profile-sidebar">
  <header class="user-profile-header">
    <span class="close-icon">
      <i data-feather="x"></i>
    </span>
    <!-- User Profile image with name -->
    <div class="header-profile-sidebar">
      <div class="avatar box-shadow-1 avatar-border avatar-xl">
        <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="user_avatar" height="70" width="70" />
        <span class="avatar-status-busy avatar-status-lg"></span>
      </div>
      <h4 class="chat-user-name">Kristopher Candy</h4>
      <span class="user-post">UI/UX Designer 👩🏻‍💻</span>
    </div>
    <!--/ User Profile image with name -->
  </header>
  <div class="user-profile-sidebar-area">
    <!-- About User -->
    <h6 class="section-label mb-1">About</h6>
    <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop.</p>
    <!-- About User -->
    <!-- User's personal information -->
    <div class="personal-info">
      <h6 class="section-label mb-1 mt-3">Personal Information</h6>
      <ul class="list-unstyled">
        <li class="mb-1">
          <i data-feather="mail" class="font-medium-2 mr-50"></i>
          <span class="align-middle">kristycandy@email.com</span>
        </li>
        <li class="mb-1">
          <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
          <span class="align-middle">+1(123) 456 - 7890</span>
        </li>
        <li>
          <i data-feather="clock" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Mon - Fri 10AM - 8PM</span>
        </li>
      </ul>
    </div>
    <!--/ User's personal information -->

    <!-- User's Links -->
    <div class="more-options">
      <h6 class="section-label mb-1 mt-3">Options</h6>
      <ul class="list-unstyled">
        <li class="cursor-pointer mb-1">
          <i data-feather="tag" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Add Tag</span>
        </li>
        <li class="cursor-pointer mb-1">
          <i data-feather="star" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Important Contact</span>
        </li>
        <li class="cursor-pointer mb-1">
          <i data-feather="image" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Shared Media</span>
        </li>
        <li class="cursor-pointer mb-1">
          <i data-feather="trash" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Delete Contact</span>
        </li>
        <li class="cursor-pointer">
          <i data-feather="slash" class="font-medium-2 mr-50"></i>
          <span class="align-middle">Block Contact</span>
        </li>
      </ul>
    </div>
    <!--/ User's Links -->
  </div>
</div>
<!--/ User Chat profile right area -->
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/app-chat.js')) }}"></script>
@endsection
