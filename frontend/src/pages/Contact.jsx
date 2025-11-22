import React, { useState } from 'react';
import styled from 'styled-components';
import { motion } from 'framer-motion';
import { FaEnvelope, FaPhone, FaMapMarkerAlt, FaPaperPlane } from 'react-icons/fa';

// Styled components
const ContactContainer = styled(motion.div)`
  max-width: 1200px;
  margin: 2rem auto;
  padding: 2rem;
  color: #333;
`;

const Header = styled(motion.h1)`
  font-size: 3rem;
  color: #2c3e50;
  margin-bottom: 1rem;
  text-align: center;
  background: linear-gradient(90deg, #3498db, #2c3e50);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
`;

const Subheader = styled(motion.p)`
  font-size: 1.5rem;
  text-align: center;
  margin-bottom: 3rem;
  color: #7f8c8d;
`;

const ContactGrid = styled.div`
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;

  @media (min-width: 992px) {
    grid-template-columns: 1fr 1fr;
  }
`;

const ContactInfo = styled(motion.div)`
  background: #f8f9fa;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
`;

const ContactForm = styled(motion.form)`
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  background: #fff;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
`;

const InfoItem = styled.div`
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  margin-bottom: 1.5rem;

  svg {
    color: #3498db;
    font-size: 1.5rem;
    margin-top: 0.3rem;
  }
`;

const InfoContent = styled.div`
  h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
  }

  p, a {
    color: #7f8c8d;
    text-decoration: none;
    transition: color 0.3s ease;

    &:hover {
      color: #3498db;
    }
  }
`;

const FormGroup = styled.div`
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
`;

const Label = styled.label`
  color: #2c3e50;
  font-weight: 500;
`;

const Input = styled.input`
  padding: 0.8rem 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 1rem;
  transition: all 0.3s ease;

  &:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
  }
`;

const TextArea = styled.textarea`
  padding: 0.8rem 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 1rem;
  min-height: 150px;
  resize: vertical;
  transition: all 0.3s ease;

  &:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
  }
`;

const SubmitButton = styled(motion.button)`
  background: linear-gradient(90deg, #3498db, #2c3e50);
  color: white;
  border: none;
  padding: 1rem 2rem;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  transition: all 0.3s ease;

  &:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  &:disabled {
    background: #bdc3c7;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
  }
`;

const SuccessMessage = styled(motion.div)`
  background: #2ecc71;
  color: white;
  padding: 1rem;
  border-radius: 5px;
  text-align: center;
  margin-top: 1rem;
`;

// Animation variants
const containerVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.2,
      when: "beforeChildren"
    }
  }
};

const itemVariants = {
  hidden: { y: 20, opacity: 0 },
  visible: {
    y: 0,
    opacity: 1,
    transition: {
      duration: 0.5
    }
  }
};

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: ''
  });

  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    
    // Simulate form submission
    setTimeout(() => {
      console.log('Form submitted:', formData);
      setIsSubmitting(false);
      setIsSuccess(true);
      setFormData({
        name: '',
        email: '',
        subject: '',
        message: ''
      });
      
      // Hide success message after 5 seconds
      setTimeout(() => setIsSuccess(false), 5000);
    }, 1500);
  };

  return (
    <ContactContainer
      initial="hidden"
      animate="visible"
      variants={containerVariants}
    >
      <Header variants={itemVariants}>Contact Us</Header>
      <Subheader variants={itemVariants}>We'd love to hear from you</Subheader>
      
      <ContactGrid>
        <ContactInfo variants={itemVariants}>
          <InfoItem>
            <FaMapMarkerAlt />
            <InfoContent>
              <h3>Our Location</h3>
              <p>Kombolcha</p>
            </InfoContent>
          </InfoItem>
          
          <InfoItem>
            <FaPhone />
            <InfoContent>
              <h3>Phone</h3>
              <p>+251 983428907</p>
             
            </InfoContent>
          </InfoItem>
          
          <InfoItem>
            <FaEnvelope />
            <InfoContent>
              <h3>Email</h3>
              <a href="mailto:info@company.com">reporting@gmail.com</a>
              <p>Response within 24 hours</p>
            </InfoContent>
          </InfoItem>
        </ContactInfo>
        
        <ContactForm 
          onSubmit={handleSubmit}
          variants={itemVariants}
        >
    
          
     
          
          {isSuccess && (
            <SuccessMessage
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
            >
              Thank you! Your message has been sent successfully.
            </SuccessMessage>
          )}
        </ContactForm>
      </ContactGrid>
    </ContactContainer>
  );
};

export default Contact;