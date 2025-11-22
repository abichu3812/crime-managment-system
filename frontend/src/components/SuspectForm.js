import React, { useState } from 'react';
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
    status: 'wanted'
  });

  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [successMessage, setSuccessMessage] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    setErrors({});
    setSuccessMessage('');

    try {
      const response = await axios.post(
        'http://localhost:8000/api/suspects',
        formData,
        {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        }
      );

      setSuccessMessage('Suspect report submitted successfully!');
      setFormData({
        full_name: '',
        age: '',
        gender: 'male',
        description: '',
        address: '',
        last_known_location: '',
        status: 'wanted'
      });
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

  return (
      <div className="max-w-4xl mx-auto transform transition-all duration-300 hover:scale-[1.005]">
        <div className="bg-white rounded-2xl shadow-2xl overflow-hidden border border-white/20 backdrop-blur-sm">
          {/* Header with animated gradient */}
          <div className="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 p-8 text-white relative overflow-hidden">
            <div className="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 animate-pulse"></div>
            <div className="relative z-10 text-center">
              <h1 className="text-4xl font-extrabold tracking-tight drop-shadow-lg">
                Report Suspicious Activity
              </h1>
              <p className="mt-3 text-lg text-blue-100 max-w-2xl mx-auto">
                Your vigilance helps keep our community safe. Report any suspicious individuals or activities.
              </p>
              <div className="mt-4 flex justify-center">
                <div className="h-1 w-24 bg-blue-300 rounded-full"></div>
              </div>
            </div>
          </div>

          {/* Form container */}
          <div className="p-8 bg-white/95">
            {/* Status messages */}
            {successMessage && (
              <div className="mb-6 p-4 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-200 flex items-center animate-fade-in">
                <div className="flex-shrink-0">
                  <svg className="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div className="ml-3 text-sm font-medium">
                  {successMessage}
                </div>
              </div>
            )}

            {errors.general && (
              <div className="mb-6 p-4 bg-rose-50 text-rose-800 rounded-xl border border-rose-200 flex items-center animate-fade-in">
                <div className="flex-shrink-0">
                  <svg className="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div className="ml-3 text-sm font-medium">
                  {errors.general}
                </div>
              </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-8">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                {/* Full Name */}
                <div className="space-y-3">
                  <label className="block text-sm font-medium text-gray-700" htmlFor="full_name">
                    Full Name <span className="text-rose-500">*</span>
                  </label>
                  <div className="relative">
                    <input
                      type="text"
                      id="full_name"
                      name="full_name"
                      value={formData.full_name}
                      onChange={handleChange}
                      className={`block w-full px-5 py-3 rounded-xl border-2 ${errors.full_name ? 'border-rose-300 focus:ring-rose-500 focus:border-rose-500' : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500'} focus:ring-2 focus:outline-none transition placeholder-gray-400`}
                    
                      required
                    />
                    <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                      <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>
                  </div>
                  {errors.full_name && <p className="mt-1 text-sm text-rose-600 animate-fade-in">{errors.full_name[0]}</p>}
                </div>

                {/* Age */}
                <div className="space-y-3">
                  <label className="block text-sm font-medium text-gray-700" htmlFor="age">
                    Age
                  </label>
                  <div className="relative">
                    <input
                      type="number"
                      id="age"
                      name="age"
                      value={formData.age}
                      onChange={handleChange}
                      className={`block w-full px-5 py-3 rounded-xl border-2 ${errors.age ? 'border-rose-300 focus:ring-rose-500 focus:border-rose-500' : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500'} focus:ring-2 focus:outline-none transition placeholder-gray-400`}
                    
                      min="1"
                      max="120"
                    />
                    <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                      <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                  </div>
                  {errors.age && <p className="mt-1 text-sm text-rose-600 animate-fade-in">{errors.age[0]}</p>}
                </div>

                {/* Gender */}
                <div className="space-y-3">
                  <label className="block text-sm font-medium text-gray-700" htmlFor="gender">
                    Gender
                  </label>
                  <div className="relative">
                    <select
                      id="gender"
                      name="gender"
                      value={formData.gender}
                      onChange={handleChange}
                      className="block w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:ring-blue-500 focus:border-blue-500 focus:ring-2 focus:outline-none transition appearance-none"
                    >
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                     
                    </select>
                    <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                      <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>
                  </div>
                </div>

                {/* Status */}
                <div className="space-y-3">
                  <label className="block text-sm font-medium text-gray-700" htmlFor="status">
                    Status
                  </label>
                  <div className="relative">
                    <select
                      id="status"
                      name="status"
                      value={formData.status}
                      onChange={handleChange}
                      className="block w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:ring-blue-500 focus:border-blue-500 focus:ring-2 focus:outline-none transition appearance-none"
                    >
                      <option value="wanted">Wanted</option>
                      <option value="missing">Missing</option>
                      <option value="person_of_interest">Person of Interest</option>
                    </select>
                    <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                      <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              {/* Description */}
              <div className="space-y-3">
                <label className="block text-sm font-medium text-gray-700" htmlFor="description">
                  Description <span className="text-rose-500">*</span>
                </label>
                <div className="relative">
                  <textarea
                    id="description"
                    name="description"
                    value={formData.description}
                    onChange={handleChange}
                    rows="4"
                    className={`block w-full px-5 py-3 rounded-xl border-2 ${errors.description ? 'border-rose-300 focus:ring-rose-500 focus:border-rose-500' : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500'} focus:ring-2 focus:outline-none transition placeholder-gray-400`}
                    placeholder="Provide a detailed description of the individual..."
                    required
                  ></textarea>
                  <div className="absolute top-3 right-3">
                    <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                  </div>
                </div>
                {errors.description && <p className="mt-1 text-sm text-rose-600 animate-fade-in">{errors.description[0]}</p>}
              </div>

              {/* Address */}
              <div className="space-y-3">
                <label className="block text-sm font-medium text-gray-700" htmlFor="address">
                  Address
                </label>
                <div className="relative">
                  <input
                    type="text"
                    id="address"
                    name="address"
                    value={formData.address}
                    onChange={handleChange}
                    className="block w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:ring-blue-500 focus:border-blue-500 focus:ring-2 focus:outline-none transition placeholder-gray-400"
                  />
                  <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                </div>
              </div>

              {/* Last Known Location */}
              <div className="space-y-3">
                <label className="block text-sm font-medium text-gray-700" htmlFor="last_known_location">
                  Last Known Location <span className="text-rose-500">*</span>
                </label>
                <div className="relative">
                  <input
                    type="text"
                    id="last_known_location"
                    name="last_known_location"
                    value={formData.last_known_location}
                    onChange={handleChange}
                    className={`block w-full px-5 py-3 rounded-xl border-2 ${errors.last_known_location ? 'border-rose-300 focus:ring-rose-500 focus:border-rose-500' : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500'} focus:ring-2 focus:outline-none transition placeholder-gray-400`}
                    
                    required
                  />
                  <div className="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                  </div>
                </div>
                {errors.last_known_location && <p className="mt-1 text-sm text-rose-600 animate-fade-in">{errors.last_known_location[0]}</p>}
              </div>

              {/* Submit Button */}
              <div className="pt-4">
                <button
                  type="submit"
                  disabled={isSubmitting}
                  className={`w-full py-4 px-6 rounded-xl font-bold text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 ${isSubmitting ? 'bg-blue-400 cursor-not-allowed' : 'bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 hover:shadow-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-600/30'}`}
                >
                  {isSubmitting ? (
                    <span className="flex items-center justify-center space-x-2">
                      <svg className="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      <span>Submitting Report...</span>
                    </span>
                  ) : (
                    <span className="flex items-center justify-center space-x-2">
                      <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                      </svg>
                      <span>Submit Report</span>
                    </span>
                )}
                </button>
              </div>
            </form>
          </div>

          {/* Footer */}
          <div className="bg-gray-50 px-8 py-6 border-t border-gray-200">
            <div className="flex items-center justify-center">
              <svg className="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
              <p className="text-xs text-gray-500 text-center">
                All information is encrypted and kept confidential according to our privacy policy.
              </p>
            </div>
          </div>
        </div>
      </div>
 
  );
};

export default SuspectForm;