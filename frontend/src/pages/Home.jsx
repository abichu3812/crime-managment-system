import React from 'react';
import styled from 'styled-components';
import { FaShieldAlt, FaExclamationTriangle, FaEye, FaUserSecret } from 'react-icons/fa';

const HomeContainer = styled.div`
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  color: #fff;
`;

const HeroSection = styled.section`
  background: rgba(15, 23, 42, 0.7);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  padding: 4rem 2rem;
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  text-align: center;
  margin-bottom: 3rem;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
`;

const HeroTitle = styled.h1`
  font-size: 3rem;
  color: #64ffda;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
`;

const HeroSubtitle = styled.p`
  font-size: 1.25rem;
  color: #e2e8f0;
  max-width: 800px;
  margin: 0 auto 2rem;
  line-height: 1.6;
`;

const EmergencyBanner = styled.div`
  background: linear-gradient(90deg, rgba(231, 76, 60, 0.8), rgba(192, 57, 43, 0.8));
  color: white;
  padding: 1rem;
  border-radius: 8px;
  text-align: center;
  margin-bottom: 2rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  backdrop-filter: blur(5px);
`;

const FeaturesGrid = styled.div`
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-top: 3rem;
`;

const FeatureCard = styled.div`
  background: rgba(15, 23, 42, 0.7);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  padding: 2rem;
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.3s ease;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);

  &:hover {
    transform: translateY(-5px);
    border-color: rgba(100, 255, 218, 0.4);
  }
`;

const FeatureIcon = styled.div`
  font-size: 2.5rem;
  color: #64ffda;
  margin-bottom: 1rem;
`;

const FeatureTitle = styled.h3`
  color: #e2e8f0;
  margin-bottom: 1rem;
  font-size: 1.5rem;
`;

const FeatureDescription = styled.p`
  color: #94a3b8;
  line-height: 1.6;
`;

const ReportButton = styled.button`
  background: linear-gradient(90deg, rgba(231, 76, 60, 0.8), rgba(192, 57, 43, 0.8));
  color: white;
  border: none;
  padding: 1rem 2rem;
  font-size: 1.1rem;
  font-weight: 500;
  border-radius: 8px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  transition: all 0.3s ease;
  margin-top: 2rem;
  backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.1);

  &:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3);
  }
`;

const Home = () => {
  return (
    <HomeContainer>
      <HeroSection>
        <HeroTitle>
          <FaShieldAlt /> Suspicious Activity Reporting Portal
        </HeroTitle>
        <HeroSubtitle>
          Report suspicious activities and help maintain security in our community.
          Your vigilance makes a difference.
        </HeroSubtitle>
        
        
        
        <ReportButton as="a" href="/report">
          <FaExclamationTriangle /> Report Suspicious Activity
        </ReportButton>
      </HeroSection>

      <FeaturesGrid>
        <FeatureCard>
          <FeatureIcon>
            <FaEye />
          </FeatureIcon>
          <FeatureTitle>Recognize Suspicious Behavior</FeatureTitle>
          <FeatureDescription>
            Learn to identify potential threats including unattended packages,
            unauthorized access attempts, and unusual surveillance activities.
          </FeatureDescription>
        </FeatureCard>

        <FeatureCard>
          <FeatureIcon>
            <FaUserSecret />
          </FeatureIcon>
          <FeatureTitle>Anonymous Reporting</FeatureTitle>
          <FeatureDescription>
            Submit reports confidentially. Your identity remains protected while
            helping keep the community safe.
          </FeatureDescription>
        </FeatureCard>

        <FeatureCard>
          <FeatureIcon>
            <FaShieldAlt />
          </FeatureIcon>
          <FeatureTitle>Rapid Response</FeatureTitle>
          <FeatureDescription>
            Our security team reviews all reports promptly, with critical threats
            addressed immediately.
          </FeatureDescription>
        </FeatureCard>
      </FeaturesGrid>
    </HomeContainer>
  );
};

export default Home;