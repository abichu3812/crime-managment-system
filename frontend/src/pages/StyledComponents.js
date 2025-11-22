import styled from 'styled-components';
import { motion } from 'framer-motion';

export const AboutContainer = styled(motion.div)`
  max-width: 1400px;
  margin: 0 auto;
  padding: 3rem 1.5rem;
  color: #e5e7eb;
  background: linear-gradient(145deg, #0a0e17 0%, #1a2332 100%);
  position: relative;
  overflow: hidden;

  &:before {
    content: '';
    position: absolute;
    top: -50px;
    left: -50px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.2), transparent);
    filter: blur(100px);
    animation: float 10s ease-in-out infinite;
  }

  &:after {
    content: '';
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(236, 72, 153, 0.2), transparent);
    filter: blur(100px);
    animation: float 12s ease-in-out infinite 2s;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
  }

  @media (max-width: 640px) {
    padding: 2rem 1rem;
  }
`;

export const Header = styled(motion.h1)`
  font-size: 3.5rem;
  font-weight: 800;
  text-align: center;
  background: linear-gradient(90deg, #3b82f6, #ec4899);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1.5rem;
  text-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
  letter-spacing: -0.025em;

  @media (max-width: 640px) {
    font-size: 2.5rem;
  }
`;

export const Subheader = styled(motion.p)`
  font-size: 1.75rem;
  text-align: center;
  margin-bottom: 4rem;
  color: #94a3b8;
  font-weight: 300;
  text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);

  @media (max-width: 640px) {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
  }
`;

export const ContentSection = styled.div`
  display: flex;
  flex-direction: column;
  gap: 4rem;

  @media (min-width: 1024px) {
    flex-direction: row;
  }
`;

export const TextContent = styled.div`
  flex: 1;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(20px);
  border-radius: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);

  @media (max-width: 640px) {
    padding: 1.5rem;
  }
`;

export const TeamImage = styled(motion.div)`
  flex: 1;
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
  background: linear-gradient(135deg, #3b82f6, #ec4899);
  min-height: 400px;
  position: relative;
  transition: transform 0.5s ease;

  .fallback-text {
    display: none;
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
  }

  &:hover {
    transform: translateY(-10px);
  }

  @media (max-width: 1024px) {
    min-height: 300px;
  }

  &:before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
    transition: opacity 0.3s ease;
  }

  &:hover:before {
    opacity: 0.5;
  }
`;

export const SectionTitle = styled.h2`
  font-size: 2.25rem;
  color: #e5e7eb;
  margin-bottom: 1.5rem;
  position: relative;
  display: inline-block;
  font-weight: 700;

  &:after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60%;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #ec4899);
    box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
  }

  @media (max-width: 640px) {
    font-size: 1.75rem;
  }
`;

export const Paragraph = styled.p`
  font-size: 1.125rem;
  line-height: 1.8;
  margin-bottom: 1.75rem;
  color: #d1d5db;
  font-weight: 400;

  @media (max-width: 640px) {
    font-size: 1rem;
  }
`;

export const ValuesList = styled.ul`
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
  margin: 2.5rem 0;
`;

export const ValueItem = styled(motion.li)`
  background: rgba(255, 255, 255, 0.08);
  padding: 2rem;
  border-radius: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.15);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  list-style: none;
  transition: all 0.4s ease;
  cursor: pointer;

  h3 {
    color: #93c5fd;
    margin-bottom: 0.75rem;
    font-size: 1.5rem;
    font-weight: 600;
  }

  p {
    color: #d1d5db;
    font-size: 1rem;
  }

  &:hover {
    transform: translateY(-8px);
    border-color: rgba(59, 130, 246, 0.5);
    background: rgba(255, 255, 255, 0.1);
  }
`;

export const TimelineContainer = styled.div`
  position: relative;
  padding: 2rem 0;
  margin: 2rem 0;

  &:before {
    content: '';
    position: absolute;
    top: 0;
    left: 20px;
    height: 100%;
    width: 4px;
    background: linear-gradient(to bottom, #3b82f6, #ec4899);
    border-radius: 2px;
  }

  @media (min-width: 768px) {
    &:before {
      left: 50%;
      transform: translateX(-50%);
    }
  }
`;

export const TimelineItem = styled(motion.div)`
  position: relative;
  margin-bottom: 2rem;
  padding-left: 60px;

  @media (min-width: 768px) {
    width: 50%;
    padding: 0 2rem;
    margin-bottom: 3rem;

    &:nth-child(odd) {
      left: 0;
      text-align: right;
    }

    &:nth-child(even) {
      left: 50%;
      text-align: left;
    }
  }
`;

export const TimelineDot = styled.div`
  position: absolute;
  width: 16px;
  height: 16px;
  background: #3b82f6;
  border: 3px solid #ffffff;
  border-radius: 50%;
  top: 10px;
  left: 12px;
  box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);

  @media (min-width: 768px) {
    left: 50%;
    transform: translateX(-50%);
  }
`;

export const TimelineContent = styled.div`
  background: rgba(255, 255, 255, 0.1);
  padding: 1.5rem;
  border-radius: 0.75rem;
  border: 1px solid rgba(255, 255, 255, 0.15);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);

  h3 {
    color: #93c5fd;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
  }

  p {
    color: #d1d5db;
    font-size: 1rem;
  }

  @media (min-width: 768px) {
    max-width: 400px;
  }
`;

export const CTAButton = styled(motion.button)`
  display: inline-flex;
  align-items: center;
  padding: 1rem 2rem;
  font-size: 1.125rem;
  font-weight: 600;
  color: #ffffff;
  background: linear-gradient(90deg, #3b82f6, #ec4899);
  border: none;
  border-radius: 0.75rem;
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;

  &:hover {
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    transform: translateY(-2px);
  }

  &:focus {
    outline: 2px solid #93c5fd;
    outline-offset: 2px;
  }

  &:after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
  }

  &:hover:after {
    width: 300px;
    height: 300px;
  }

  @media (max-width: 640px) {
    width: 100%;
    justify-content: center;
  }
`;