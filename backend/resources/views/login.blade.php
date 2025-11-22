<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Advanced Criminal Information Management System - Secure Law Enforcement Platform">
  <meta name="author" content="Law Enforcement Division">
  <meta name="keywords" content="criminal, Information, management, system, law enforcement, security, database">

  <title>Criminal Intelligence Platform - Secure Access</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.comrigin">



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

  <!-- Layout Styles -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
  
  <style type="text/css">
    :root {
      --primary-color: #0a192f;
      --secondary-color: #64ffda;
      --accent-color: #1e90ff;
      --dark-color: #020c1b;
      --light-color: #ccd6f6;
      --alert-color: #ff5555;
      --neon-glow: 0 0 10px rgba(100, 255, 218, 0.7);
      --report-color: #ff6b6b;
    }
    
    body {
      background-color: var(--dark-color);
      font-family: 'Montserrat', sans-serif;
      background-image: radial-gradient(circle at 75% 25%, rgba(30, 144, 255, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 25% 75%, rgba(100, 255, 218, 0.1) 0%, transparent 50%);
      min-height: 100vh;
      overflow-x: hidden;
    }
    
    .auth-page {
      margin:0px;
      background: rgba(107, 5, 27, 0.85);
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .auth-page:hover {
      transform: translateY(-5px);
    }
    
    .auth-page::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('{{ asset("upload/digital-grid.png") }}') center/cover;
      opacity: 0.1;
      z-index: 0;
    }
    
    .card {
      background-color: rgba(51, 3, 14, 0.85);
      border: none;
      border-radius: 0;
      backdrop-filter: blur(8px);
      overflow: hidden;
      position: relative;
    }
    
    .card::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(
        to bottom right,
        rgba(100, 255, 218, 0) 0%,
        rgba(100, 255, 218, 0.1) 20%,
        rgba(100, 255, 218, 0) 40%
      );
      transform: rotate(30deg);
      animation: shine 6s infinite linear;
    }
    
    .auth-form-wrapper {
      padding: 3rem;
      position: relative;
      z-index: 2;
    }
    
    /* Main header with digital animation */
    .noble-ui-logo {
      text-align: center;
      margin-bottom: 2.5rem;
      position: relative;
      overflow: hidden;
      padding-bottom: 1rem;
    }
    
    .noble-ui-logo::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 25%;
      width: 50%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--secondary-color), transparent);
      animation: lineGlow 3s infinite;
    }
    
    .typing-logo-text {
      display: block;
      font-size: 2.8rem;
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
      color: var(--light-color);
      text-shadow: var(--neon-glow);
      letter-spacing: 2px;
      margin-bottom: 0.5rem;
      position: relative;
      background: linear-gradient(90deg, var(--light-color), var(--secondary-color));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: textGlow 2s infinite alternate;
    }
    
    .pulse-subtext {
      display: block;
      color: var(--secondary-color);
      font-size: 1.3rem;
      font-weight: 400;
      margin-top: 0.5rem;
      text-align: center;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      position: relative;
    }
    
    .pulse-subtext::before,
    .pulse-subtext::after {
      content: '//';
      color: var(--accent-color);
      margin: 0 10px;
      opacity: 0.7;
    }
    
    /* Form styling */
    .forms-sample {
      position: relative;
    }
    
    .forms-sample .form-label {
      color: var(--light-color);
      font-weight: 600;
      font-size: 0.95rem;
      margin-bottom: 0.75rem;
      display: block;
      letter-spacing: 0.5px;
    }
    
    .forms-sample .form-control {
      background-color: rgba(100, 255, 218, 0.05);
      border: 1px solid rgba(100, 255, 218, 0.2);
      color: var(--light-color);
      border-radius: 6px;
      padding: 0.85rem 1.25rem;
      transition: all 0.3s ease;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .forms-sample .form-control:focus {
      background-color: rgba(100, 255, 218, 0.1);
      border-color: var(--secondary-color);
      box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.15);
      color: white;
    }
    
    .forms-sample .form-control::placeholder {
      color: rgba(204, 214, 246, 0.5);
      font-weight: 400;
    }
    
    /* Input container with floating effect */
    .input-container {
      position: relative;
      margin-bottom: 1.75rem;
    }
    
    .input-container::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }
    
    .input-container:focus-within::after {
      transform: scaleX(1);
    }
    
    /* Password toggle */
    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: rgba(204, 214, 246, 0.6);
      transition: all 0.3s ease;
      z-index: 3;
    }
    
    .password-toggle:hover {
      color: var(--secondary-color);
      transform: translateY(-50%) scale(1.1);
    }
    
    /* Button styling */
    .auth-btn {
      background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
      color: var(--dark-color);
      border: none;
      padding: 1rem 2rem;
      font-weight: 700;
      letter-spacing: 1px;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(30, 144, 255, 0.4);
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      margin-top: 1rem;
    }
    
    .auth-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(30, 144, 255, 0.6);
    }
    
    .auth-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: 0.5s;
    }
    
    .auth-btn:hover::before {
      left: 100%;
    }
    
    .auth-btn i {
      margin-right: 10px;
      font-size: 1.2rem;
    }
    
    /* Report Button styling */
    .report-btn {
      background: linear-gradient(135deg, var(--report-color), #ff8e8e);
      color: white;
      border: none;
      padding: 1rem 2rem;
      font-weight: 700;
      letter-spacing: 1px;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      margin-top: 1.5rem;
      text-decoration: none;
      text-align: center;
    }
    
    .report-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
      color: white;
    }
    
    .report-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: 0.5s;
    }
    
    .report-btn:hover::before {
      left: 100%;
    }
    
    .report-btn i {
      margin-right: 10px;
      font-size: 1.2rem;
    }
    
    /* Remember me checkbox */
    .form-check {
      display: flex;
      align-items: center;
    }
    
    .form-check-input {
      width: 18px;
      height: 18px;
      margin-right: 10px;
      background-color: rgba(100, 255, 218, 0.1);
      border: 1px solid var(--secondary-color);
    }
    
    .form-check-input:checked {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .form-check-label {
      color: var(--light-color);
      font-size: 0.9rem;
      cursor: pointer;
    }
    
    /* Forgot password link */
    .forgot-password {
      color: var(--accent-color);
      font-size: 0.9rem;
      text-decoration: none;
      transition: all 0.3s ease;
      position: relative;
    }
    
    .forgot-password:hover {
      color: var(--secondary-color);
      text-decoration: none;
    }
    
    .forgot-password::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 1px;
      background: var(--secondary-color);
      transition: width 0.3s ease;
    }
    
    .forgot-password:hover::after {
      width: 100%;
    }
    
    /* Error message */
    .alert-danger {
      background-color: rgba(255, 85, 85, 0.15);
      border-left: 4px solid var(--alert-color);
      color: var(--light-color);
      border-radius: 4px;
      padding: 1rem;
      margin-bottom: 1.75rem;
      display: flex;
      align-items: center;
      animation: shake 0.5s ease;
    }
    
    .alert-danger i {
      margin-right: 10px;
      color: var(--alert-color);
    }
    
    /* Password strength meter */
    .password-strength {
      height: 5px;
      background-color: rgba(100, 255, 218, 0.1);
      margin-top: 0.75rem;
      border-radius: 5px;
      overflow: hidden;
      position: relative;
    }
    
    .password-strength-bar {
      height: 100%;
      width: 0%;
      background: linear-gradient(90deg, var(--alert-color), #ff9800, var(--secondary-color));
      transition: width 0.3s ease, background-color 0.3s ease;
      border-radius: 5px;
    }
    
    /* Security warning */
    .security-warning {
      font-size: 0.8rem;
      color: rgba(204, 214, 246, 0.6);
      margin-top: 2rem;
      text-align: center;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(100, 255, 218, 0.1);
      position: relative;
    }
    
    .security-warning i {
      color: var(--secondary-color);
      margin-right: 8px;
    }
    
    /* Animations */
    @keyframes shine {
      0% { transform: rotate(30deg) translate(-30%, -30%); }
      100% { transform: rotate(30deg) translate(30%, 30%); }
    }
    
    @keyframes lineGlow {
      0% { opacity: 0.3; }
      50% { opacity: 1; }
      100% { opacity: 0.3; }
    }
    
    @keyframes textGlow {
      0% { text-shadow: 0 0 10px rgba(100, 255, 218, 0.5); }
      100% { text-shadow: 0 0 20px rgba(100, 255, 218, 0.8); }
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-5px); }
      40%, 80% { transform: translateX(5px); }
    }
    
    /* Pulsing emergency animation */
    @keyframes pulseEmergency {
      0% { box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7); }
      70% { box-shadow: 0 0 0 10px rgba(255, 107, 107, 0); }
      100% { box-shadow: 0 0 0 0 rgba(255, 107, 107, 0); }
    }
    
    .emergency-pulse {
      animation: pulseEmergency 2s infinite;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .auth-form-wrapper {
        padding: 2rem;
      }
      
      .typing-logo-text {
        font-size: 2rem;
      }
      
      .pulse-subtext {
        font-size: 1.1rem;
      }
      
      .auth-btn, .report-btn {
        padding: 0.9rem 1.5rem;
      }
    }
    
    /* Digital particle background */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }
    
    .particle {
      position: absolute;
      background-color: rgba(100, 255, 218, 0.5);
      border-radius: 50%;
      animation: floatParticle linear infinite;
    }
    
    @keyframes floatParticle {
      0% { transform: translateY(0) translateX(0); opacity: 0; }
      10% { opacity: 1; }
      90% { opacity: 1; }
      100% { transform: translateY(-100vh) translateX(100px); opacity: 0; }
    }
  </style>
</head>
<body>
  <!-- Digital particle background -->
  <div class="particles" id="particles"></div>

  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page" style="margin: 0px;">
          <div class="col-md-8 col-xl-6 mx-auto" style="margin: 20px;">
            <div class="card">
              <div class="row">
                <div class="col-md-12 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-4">
                      <span class="typing-logo-text">CRIMINAL Information </span>
                      <span class="pulse-subtext">MANAGEMENT SYSTEM Login Page</span>
                    </a>
                                        
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <i class="feather icon-alert-circle mr-2"></i> Authentication failed. Please verify your credentials.
                      </div>
                    @endif
                    
                    <form class="forms-sample" method="POST" action="{{ route('login') }}" id="logInformationrm">
                      @csrf
                      <div class="input-container mb-4">
                        <label for="login" class="form-label">Email</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Enter your badge or agent ID" required autocomplete="off">
                        <i class="feather icon-user password-toggle"></i>
                      </div>
                      
                      <div class="input-container mb-4">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your secure passcode" required>
                        <i class="feather icon-eye password-toggle" id="togglePassword"></i>
        

                      </div>
                      <div class="input-container mb-4">
                            <input style="font-size:20px;font-weight:bold" type="submit" class="form-control" placeholder="Enter your secure passcode" required value="Login">

                        </div>
            </div>
        </div>
      </div>

  <!-- Core JS -->
  <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>

  <!-- Plugins JS -->
  <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/template.js') }}"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Create digital particle background
      createParticles();
      
      // Password toggle functionality
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');
      
      togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('icon-eye-off');
      });
      
      // Password strength indicator
      password.addEventListener('input', function() {
        const strengthBar = document.querySelector('#passwordStrength');
        const strength = calculatePasswordStrength(this.value);
        
        strengthBar.style.width = strength.percentage + '%';
      });
      
      function calculatePasswordStrength(password) {
        let strength = 0;
        
        // Length check
        if (password.length > 0) strength += 10;
        if (password.length >= 8) strength += 20;
        if (password.length >= 12) strength += 20;
        
        // Character variety
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[a-z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;
        
        // Clamp between 0-100
        strength = Math.max(0, Math.min(100, strength));
        
        return {
          percentage: strength
        };
      }
      
      // Form submission animation
      const logInformationrm = document.querySelector('#logInformationrm');
      logInformationrm.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="feather icon-loader spin mr-1"></i> VERIFYING CREDENTIALS...';
        submitBtn.disabled = true;
      });
      
      // Create floating particles
      function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = window.innerWidth < 768 ? 30 : 50;
        
        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement('div');
          particle.classList.add('particle');
          
          // Random properties
          const size = Math.random() * 3 + 1;
          const posX = Math.random() * 100;
          const duration = Math.random() * 20 + 10;
          const delay = Math.random() * 10;
          
          particle.style.width = `${size}px`;
          particle.style.height = `${size}px`;
          particle.style.left = `${posX}%`;
          particle.style.animationDuration = `${duration}s`;
          particle.style.animationDelay = `${delay}s`;
          
          particlesContainer.appendChild(particle);
        }
      }
    });
  </script>
</body>
</html>