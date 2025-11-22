import React, { useState, useRef } from 'react';
import axios from 'axios';
import './../App.css';

const SuspectForm = () => {
  const [formData, setFormData] = useState({
    full_name: '',
    age: '',
    gender: 'male',
    description: '',
    address: '',
    last_known_location: '',
    status: 'wanted',
    video: null,
    audio: null,
    videoPreview: '',
    audioPreview: ''
  });

  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [successMessage, setSuccessMessage] = useState('');
  const [currentStep, setCurrentStep] = useState(1);
  const formRef = useRef(null);
  const fileInputRef = useRef(null);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleFileChange = (e) => {
    const { name, files } = e.target;
    const file = files[0];
    
    if (file) {
      // For preview purposes
      if (name === 'video') {
        const videoURL = URL.createObjectURL(file);
        setFormData(prev => ({
          ...prev,
          video: file,
          videoPreview: videoURL
        }));
      } else if (name === 'audio') {
        const audioURL = URL.createObjectURL(file);
        setFormData(prev => ({
          ...prev,
          audio: file,
          audioPreview: audioURL
        }));
      }
    }
  };

  const removeMedia = (type) => {
    if (type === 'video') {
      URL.revokeObjectURL(formData.videoPreview);
      setFormData(prev => ({
        ...prev,
        video: null,
        videoPreview: ''
      }));
    } else {
      URL.revokeObjectURL(formData.audioPreview);
      setFormData(prev => ({
        ...prev,
        audio: null,
        audioPreview: ''
      }));
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (currentStep < 3) {
      setCurrentStep(currentStep + 1);
      formRef.current.scrollTo({ top: 0, behavior: 'smooth' });
      return;
    }

    setIsSubmitting(true);
    setErrors({});
    setSuccessMessage('');

    try {
      const formDataToSend = new FormData();
      
      // Append all form data to FormData object
      Object.keys(formData).forEach(key => {
        if (key !== 'videoPreview' && key !== 'audioPreview') {
          formDataToSend.append(key, formData[key]);
        }
      });

      const response = await axios.post(
        'http://localhost:8000/api/suspects',
        formDataToSend,
        {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Accept': 'application/json'
          }
        }
      );

      setSuccessMessage('Suspect report submitted successfully!');
      // Reset form including media files
      setFormData({
        full_name: '',
        age: '',
        gender: 'male',
        description: '',
        address: '',
        last_known_location: '',
        status: 'wanted',
        video: null,
        audio: null,
        videoPreview: '',
        audioPreview: ''
      });
      setCurrentStep(1);
    } catch (error) {
      if (error.response && error.response.status === 422) {
        setErrors(error.response.data.errors);
      } else {
        setErrors({ general: 'An error occurred while submitting the form.' });
      }
    } finally {
      setIsSubmitting(false);
    }
  };

  const nextStep = () => {
    if (currentStep < 3) {
      setCurrentStep(currentStep + 1);
      formRef.current.scrollTo({ top: 0, behavior: 'smooth' });
    }
  };

  const prevStep = () => {
    if (currentStep > 1) {
      setCurrentStep(currentStep - 1);
      formRef.current.scrollTo({ top: 0, behavior: 'smooth' });
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center p-4">
      <div className="space-y-8 w-full max-w-4xl">
        {/* Floating glass morphism container */}
        <div 
          ref={formRef}
          className="bg-white/5 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/10 shadow-2xl shadow-black/50 relative"
        >
          {/* Animated background elements */}
          <div className="absolute inset-0 overflow-hidden">
            <div className="absolute -top-20 -left-20 w-64 h-64 bg-blue-500/10 rounded-full filter blur-3xl animate-float"></div>
            <div className="absolute -bottom-20 -right-20 w-72 h-72 bg-purple-500/10 rounded-full filter blur-3xl animate-float-delay"></div>
          </div>
          
          {/* Header with holographic effect */}
          <div className="relative p-8 text-center border-b border-white/10 bg-gradient-to-r from-blue-900/30 to-purple-900/30">
            <div className="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
            <div className="relative z-10">
              <h1  className="text-4xl md:text-5xl font-bold bg-clip-text  bg-gradient-to-r from-blue-400 to-blue-600 tracking-tight">
                Report Suspicious Activity
              </h1>
          
            </div>
          </div>

          {/* Form container */}
          <div className="p-6 md:p-8 relative">
            {/* Status messages */}
            {successMessage && (
              <div className="mb-6 p-4 bg-emerald-900/30 text-emerald-100 rounded-xl border border-emerald-400/30 flex items-center animate-fade-in backdrop-blur-sm">
                <div className="flex-shrink-0">
                  <svg className="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div className="ml-3 text-sm font-medium">
                  {successMessage}
                </div>
              </div>
            )}

            {errors.general && (
              <div className="mb-6 p-4 bg-rose-900/30 text-rose-100 rounded-xl border border-rose-400/30 flex items-center animate-fade-in backdrop-blur-sm">
                <div className="flex-shrink-0">
                  <svg className="w-6 h-6 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div className="ml-3 text-sm font-medium">
                  {errors.general}
                </div>
              </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-10">
              {/* Step 1: Basic Information */}
              {currentStep === 1 && (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in">
                  {/* Full Name */}
                  <div className="space-y-2">
                    <label className="block text-sm font-medium text-blue-100/80" htmlFor="full_name">
                      Full Name <span className="text-rose-400">*</span>
                    </label>
                    <div className="relative group">
                      <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                      <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value={formData.full_name}
                        onChange={handleChange}
                        className={`relative block w-full px-5 py-3 rounded-xl border ${errors.full_name ? 'border-rose-400/50 bg-rose-900/20' : 'border-white/10 bg-white/5'} focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 placeholder-white/30 text-white transition-all`}
                        required
                      />
                    </div>
                    {errors.full_name && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.full_name[0]}</p>}
                  </div>

                  {/* Age */}
                  <div className="space-y-2">
                    <label className="block text-sm font-medium text-blue-100/80" htmlFor="age">
                      Age
                    </label>
                    <div className="relative group">
                      <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                      <input
                        type="number"
                        id="age"
                        name="age"
                        value={formData.age}
                        onChange={handleChange}
                        className={`relative block w-full px-5 py-3 rounded-xl border ${errors.age ? 'border-rose-400/50 bg-rose-900/20' : 'border-white/10 bg-white/5'} focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 placeholder-white/30 text-white transition-all`}
                        min="1"
                        max="120"
                      />
                    </div>
                    {errors.age && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.age[0]}</p>}
                  </div>

                  {/* Gender */}
                  <div className="space-y-2">
                    <label className="block text-sm font-medium text-blue-100/80" htmlFor="gender">
                      Gender
                    </label>
                    <div className="relative group">
                      <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                      <select
                        id="gender"
                        name="gender"
                        value={formData.gender}
                        onChange={handleChange}
                        className="relative block w-full px-5 py-3 rounded-xl border border-white/10 bg-white/5 focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 text-white appearance-none"
                      >
                        <option value="male" className="bg-gray-800">Male</option>
                        <option value="female" className="bg-gray-800">Female</option>
                      </select>
                    </div>
                  </div>

                  {/* Status */}
                  <div className="space-y-2">
                    <label className="block text-sm font-medium text-blue-100/80" htmlFor="status">
                      Status
                    </label>
                    <div className="relative group">
                      <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                      <select
                        id="status"
                        name="status"
                        value={formData.status}
                        onChange={handleChange}
                        className="relative block w-full px-5 py-3 rounded-xl border border-white/10 bg-white/5 focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 text-white appearance-none"
                      >
                        <option value="wanted" className="bg-gray-800">Wanted</option>
                        <option value="missing" className="bg-gray-800">Missing</option>
                        <option value="person_of_interest" className="bg-gray-800">Person of Interest</option>
                      </select>
                    </div>
                  </div>
                </div>
              )}

              {/* Step 2: Description and Media */}
              {currentStep === 2 && (
                <div className="animate-fade-in">
                  <div className="space-y-6">
                    {/* Description */}
                    <div className="space-y-2">
                      <label className="block text-sm font-medium text-blue-100/80" htmlFor="description">
                        Description <span className="text-rose-400">*</span>
                      </label>
                      <div className="relative group">
                        <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                        <textarea
                          id="description"
                          name="description"
                          value={formData.description}
                          onChange={handleChange}
                          rows="5"
                          className={`relative block w-full px-5 py-3 rounded-xl border ${errors.description ? 'border-rose-400/50 bg-rose-900/20' : 'border-white/10 bg-white/5'} focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 placeholder-white/30 text-white transition-all`}
                          placeholder="Provide a detailed description of the individual..."
                          required
                        ></textarea>
                      </div>
                      {errors.description && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.description[0]}</p>}
                    </div>

                    {/* Address */}
                    <div className="space-y-2">
                      <label className="block text-sm font-medium text-blue-100/80" htmlFor="address">
                        Address
                      </label>
                      <div className="relative group">
                        <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                        <input
                          type="text"
                          id="address"
                          name="address"
                          value={formData.address}
                          onChange={handleChange}
                          className="relative block w-full px-5 py-3 rounded-xl border border-white/10 bg-white/5 focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 placeholder-white/30 text-white transition-all"
                        />
                      </div>
                    </div>

                    {/* Last Known Location */}
                    <div className="space-y-2">
                      <label className="block text-sm font-medium text-blue-100/80" htmlFor="last_known_location">
                        Last Known Location <span className="text-rose-400">*</span>
                      </label>
                      <div className="relative group">
                        <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                        <input
                          type="text"
                          id="last_known_location"
                          name="last_known_location"
                          value={formData.last_known_location}
                          onChange={handleChange}
                          className={`relative block w-full px-5 py-3 rounded-xl border ${errors.last_known_location ? 'border-rose-400/50 bg-rose-900/20' : 'border-white/10 bg-white/5'} focus:ring-2 focus:outline-none focus:ring-blue-400/30 focus:border-blue-400/50 placeholder-white/30 text-white transition-all`}
                          required
                        />
                      </div>
                      {errors.last_known_location && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.last_known_location[0]}</p>}
                    </div>

                    {/* Video Upload */}
                    <div className="space-y-2">
                      <label className="block text-sm font-medium text-blue-100/80">
                        Video Evidence
                      </label>
                      <div className="relative group">
                        <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                        <div className={`relative block w-full px-5 py-3 rounded-xl border border-white/10 bg-white/5 ${errors.video ? 'border-rose-400/50 bg-rose-900/20' : ''}`}>
                          {formData.videoPreview ? (
                            <div className="flex flex-col items-center">
                              <video 
                                controls 
                                className="w-full h-48 rounded-lg mb-3 object-cover"
                                src={formData.videoPreview}
                              />
                              <button
                                type="button"
                                onClick={() => removeMedia('video')}
                                className="text-sm text-rose-400 hover:text-rose-300 flex items-center"
                              >
                                <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Remove Video
                              </button>
                            </div>
                          ) : (
                            <div className="flex flex-col items-center justify-center py-4">
                            
                              <label htmlFor="video-upload" className="cursor-pointer text-blue-300 hover:text-blue-200 text-sm font-medium">
                                Upload Video File
                              </label>
                              <input
                                id="video-upload"
                                type="file"
                                name="video"
                                accept="video/*"
                                onChange={handleFileChange}
                                className="hidden"
                              />
                              <p className="text-xs text-white/50 mt-1">MP4, MOV, AVI (Max 50MB)</p>
                            </div>
                          )}
                        </div>
                      </div>
                      {errors.video && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.video[0]}</p>}
                    </div>

                    {/* Audio Upload */}
                    <div className="space-y-2">
                      <label className="block text-sm font-medium text-blue-100/80">
                        Audio Evidence
                      </label>
                      <div className="relative group">
                        <div className="absolute inset-0 bg-blue-500/10 rounded-xl blur-md group-hover:blur-lg transition-all duration-300 opacity-0 group-hover:opacity-50"></div>
                        <div className={`relative block w-full px-5 py-3 rounded-xl border border-white/10 bg-white/5 ${errors.audio ? 'border-rose-400/50 bg-rose-900/20' : ''}`}>
                          {formData.audioPreview ? (
                            <div className="flex flex-col items-center">
                              <audio 
                                controls 
                                className="w-full mb-3"
                                src={formData.audioPreview}
                              />
                              <button
                                type="button"
                                onClick={() => removeMedia('audio')}
                                className="text-sm text-rose-400 hover:text-rose-300 flex items-center"
                              >
                                <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Remove Audio
                              </button>
                            </div>
                          ) : (
                            <div className="flex flex-col items-center justify-center py-4">
                           
                              <label htmlFor="audio-upload" className="cursor-pointer text-blue-300 hover:text-blue-200 text-sm font-medium">
                                Upload Audio File
                              </label>
                              <input
                                id="audio-upload"
                                type="file"
                                name="audio"
                                accept="audio/*"
                                onChange={handleFileChange}
                                className="hidden"
                              />
                              <p className="text-xs text-white/50 mt-1">MP3, WAV, OGG (Max 20MB)</p>
                            </div>
                          )}
                        </div>
                      </div>
                      {errors.audio && <p className="mt-1 text-sm text-rose-300 animate-fade-in">{errors.audio[0]}</p>}
                    </div>
                  </div>
                </div>
              )}

              {/* Step 3: Review */}
              {currentStep === 3 && (
                <div className="animate-fade-in">
                  <div className="bg-white/5 border border-white/10 rounded-xl p-6 mb-6">
                    <h3 className="text-lg font-medium text-blue-200 mb-4">Review Your Report</h3>
                    
                    <div className="space-y-4">
                      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                          <p className="text-sm text-white/60">Full Name</p>
                          <p className="text-white">{formData.full_name || 'Not provided'}</p>
                        </div>
                        <div>
                          <p className="text-sm text-white/60">Age</p>
                          <p className="text-white">{formData.age || 'Not provided'}</p>
                        </div>
                        <div>
                          <p className="text-sm text-white/60">Gender</p>
                          <p className="text-white capitalize">{formData.gender}</p>
                        </div>
                        <div>
                          <p className="text-sm text-white/60">Status</p>
                          <p className="text-white">{formData.status.replace(/_/g, ' ')}</p>
                        </div>
                      </div>
                      
                      <div>
                        <p className="text-sm text-white/60">Description</p>
                        <p className="text-white">{formData.description || 'Not provided'}</p>
                      </div>
                      
                      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                          <p className="text-sm text-white/60">Address</p>
                          <p className="text-white">{formData.address || 'Not provided'}</p>
                        </div>
                        <div>
                          <p className="text-sm text-white/60">Last Known Location</p>
                          <p className="text-white">{formData.last_known_location || 'Not provided'}</p>
                        </div>
                      </div>

                      {/* Media Review */}
                      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                          <p className="text-sm text-white/60">Video Evidence</p>
                          {formData.videoPreview ? (
                            <video 
                              controls 
                              className="w-full h-48 rounded-lg object-cover"
                              src={formData.videoPreview}
                            />
                          ) : (
                            <p className="text-white/50">No video uploaded</p>
                          )}
                        </div>
                        <div>
                          <p className="text-sm text-white/60">Audio Evidence</p>
                          {formData.audioPreview ? (
                            <audio 
                              controls 
                              className="w-full"
                              src={formData.audioPreview}
                            />
                          ) : (
                            <p className="text-white/50">No audio uploaded</p>
                          )}
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div className="bg-blue-900/20 border border-blue-400/30 rounded-xl p-4">
                    <div className="flex items-start">
                      <svg className="h-5 w-5 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <div className="ml-3">
                        <h4 className="text-sm font-medium text-blue-200">Before submitting</h4>
                        <p className="mt-1 text-sm text-blue-100/80">
                          Please verify all information is accurate. False reports may be subject to penalties.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              )}

              {/* Navigation buttons */}
              <div className="flex justify-between pt-6 border-t border-white/10">
                {currentStep > 1 ? (
                  <button
                    type="button"
                    onClick={prevStep}
                    className="px-6 py-3 rounded-xl font-medium text-white/80 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 transition-all duration-300 flex items-center"
                  >
                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                  </button>
                ) : (
                  <div></div>
                )}

                {currentStep < 3 ? (
                  <button
                    type="button"
                    onClick={nextStep}
                    className="px-6 py-3 rounded-xl font-medium text-white bg-blue-600 hover:bg-blue-700 transition-all duration-300 flex items-center group"
                  >
                    Continue
                    <svg className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                ) : (
                  <button
                    type="submit"
                    disabled={isSubmitting}
                    className={`px-8 py-4 rounded-xl font-bold text-white transition-all duration-300 flex items-center group ${isSubmitting ? 'bg-blue-600/70 cursor-not-allowed' : 'bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 hover:shadow-lg shadow-md shadow-blue-500/20'}`}
                  >
                    {isSubmitting ? (
                      <>
                        <svg className="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                          <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Submitting...
                      </>
                    ) : (
                      <>
                        Submit Report
                        <svg className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                      </>
                    )}
                  </button>
                )}
              </div>
            </form>
          </div>

          {/* Footer */}
          <div className="px-8 py-6 border-t border-white/10 bg-gradient-to-b from-transparent to-black/20">
            <div className="flex items-center justify-center">
              <p className="text-sm text-white/50">All information will be handled confidentially</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SuspectForm;


              // $data =new Suspect();
            // $videoPath =$request->video_path;

            // $videoname =time().'.'.$video->getClientOriginalExeption();

            // $request->video_path->move('assets',$videoname);
            // $data->video=$filename;
            // $data ->save();


            // Process file uploads