import React from 'react';
import styled from 'styled-components';
import { motion } from 'framer-motion';

// Styled components
const AboutContainer = styled(motion.div)`
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  color: #333;
`;

const Header = styled(motion.h1)`
  font-size: 3rem;
  color: #2c3e50;
  margin-bottom: 1.5rem;
  text-align: center;
  background: linear-gradient(90deg, #e74c3c, #8e44ad);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
`;

const Subheader = styled(motion.p)`
  font-size: 1.5rem;
  text-align: center;
  margin-bottom: 3rem;
  color: #7f8c8d;
`;

const ContentSection = styled.div`
  display: flex;
  flex-direction: column;
  gap: 3rem;

  @media (min-width: 768px) {
    flex-direction: row;
  }
`;

const TextContent = styled.div`
  flex: 1;
  padding: 1rem;
`;

const ReportImage = styled(motion.div)`
  flex: 1;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  background: linear-gradient(135deg, #8e44ad, #e74c3c);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  min-height: 300px;
`;

const SectionTitle = styled.h2`
  font-size: 2rem;
  color: #8e44ad;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;

  &:after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 50%;
    height: 3px;
    background: linear-gradient(90deg, #e74c3c, #8e44ad);
  }
`;

const Paragraph = styled.p`
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  color: #34495e;
`;

const ReportSteps = styled.ol`
  counter-reset: step-counter;
  margin: 2rem 0;
`;

const StepItem = styled(motion.li)`
  position: relative;
  padding-left: 3rem;
  margin-bottom: 1.5rem;
  list-style: none;
  font-size: 1.1rem;
  line-height: 1.6;

  &:before {
    counter-increment: step-counter;
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 0;
    background: linear-gradient(135deg, #e74c3c, #8e44ad);
    color: white;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
  }

  h3 {
    color: #8e44ad;
    margin-bottom: 0.5rem;
  }
`;

const NoteBox = styled(motion.div)`
  background: #f5e6ff;
  padding: 1.5rem;
  border-radius: 8px;
  border-left: 4px solid #8e44ad;
  margin: 2rem 0;

  h3 {
    color: #8e44ad;
    margin-bottom: 0.5rem;
  }
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

const About = () => {
  return (
    <AboutContainer
      initial="hidden"
      animate="visible"
      variants={containerVariants}
    >
      <Header variants={itemVariants}>Report Suspicious Activity</Header>
      <Subheader variants={itemVariants}>Your vigilance helps keep our community safe</Subheader>
      
      <ContentSection>
        <TextContent>
          <motion.div variants={itemVariants}>
            <SectionTitle>How to Report</SectionTitle>
            <Paragraph>
              If you notice any unusual or potentially harmful activity, please report it immediately. 
              Your report will be handled confidentially and investigated promptly.
            </Paragraph>
            
            <ReportSteps>
              <StepItem variants={itemVariants}>
                <h3>Identify the Activity</h3>
                <p>Note details like time, location, individuals involved, and nature of the activity.</p>
              </StepItem>
              <StepItem variants={itemVariants}>
                <h3>Gather Evidence</h3>
                <p>Take photos/screenshots if safe to do so, but never put yourself at risk.</p>
              </StepItem>
              <StepItem variants={itemVariants}>
                <h3>Submit Your Report</h3>
                <p>Use our secure reporting form or contact the designated safety team.</p>
              </StepItem>
              <StepItem variants={itemVariants}>
                <h3>Follow Up</h3>
                <p>You may be contacted for additional information during the investigation.</p>
              </StepItem>
            </ReportSteps>
          </motion.div>
          
          <motion.div variants={itemVariants}>
            <SectionTitle>What Happens Next?</SectionTitle>
            <Paragraph>
              All reports are reviewed within 24 hours by our security team. Depending on the nature 
              of the report, we may:
            </Paragraph>
            
            <ul style={{ marginLeft: '1.5rem', listStyleType: 'disc' }}>
              <motion.li variants={itemVariants}>Launch an immediate investigation</motion.li>
              <motion.li variants={itemVariants}>Notify law enforcement if warranted</motion.li>
              <motion.li variants={itemVariants}>Implement protective measures</motion.li>
              <motion.li variants={itemVariants}>Follow up with you for more details</motion.li>
            </ul>
            
            <NoteBox variants={itemVariants}>
              <h3>Important Note</h3>
              <p>
                If you believe you're witnessing an active crime or dangerous situation, 
                please contact local law enforcement immediately before filing a report with us.
              </p>
            </NoteBox>
          </motion.div>
        </TextContent>
        
        <ReportImage variants={itemVariants}>
          <span>Report any suspicious activity immediately.</span>
        </ReportImage>
      </ContentSection>
    </AboutContainer>
  );
};

export default About;