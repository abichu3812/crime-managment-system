import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import styled, { keyframes, css } from 'styled-components';

const Navbar = () => {
  const location = useLocation();

  return (
    <NavContainer>
      <Nav>
        <Logo></Logo>
        <NavList>
          {['/', '/report','/about', '/contact'].map((path, index) => (
            <NavItem key={path} index={index}>
              <NavLink 
                to={path} 
                isActive={location.pathname === path}
              >
                <span>
                  {path === '/' ? 'Home' : 
                   path === '/about' ? 'About' : 
                   path === '/report' ? 'Report' : 
                   'Contact'}
                </span>
              </NavLink>
            </NavItem>
          ))}
        </NavList>
      </Nav>
    </NavContainer>
  );
};

// Animations
const fadeIn = keyframes`
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
`;

const pulse = keyframes`
  0% { box-shadow: 0 0 0 0 rgba(100, 255, 218, 0.4); }
  70% { box-shadow: 0 0 0 10px rgba(100, 255, 218, 0); }
  100% { box-shadow: 0 0 0 0 rgba(100, 255, 218, 0); }
`;

// Styled components
const NavContainer = styled.div`
  position: sticky;
  top: 0;
  z-index: 1000;
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
`;

const Nav = styled.nav`
  background: rgba(15, 23, 42, 0.8);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
`;

const Logo = styled.div`
  font-size: 1.5rem;
  font-weight: 700;
  color: #64ffda;
  margin-right: auto;
`;

const NavList = styled.ul`
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
  gap: 2.5rem;

  @media (max-width: 768px) {
    gap: 1.5rem;
  }

  @media (max-width: 480px) {
    flex-direction: column;
    align-items: flex-end;
    gap: 1rem;
  }
`;

const NavItem = styled.li`
  position: relative;
  margin: 0;
  animation: ${fadeIn} 0.5s ease forwards;
  animation-delay: ${props => props.index * 0.1}s;
  opacity: 0;
`;

const NavLink = styled(Link)`
  color: ${({ isActive }) => (isActive ? '#64ffda' : '#e2e8f0')};
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  
  span {
    position: relative;
    z-index: 2;
    transition: transform 0.3s ease;
  }

  &:hover {
    color: #64ffda;
    
    span {
      transform: translateY(-2px);
    }
  }

  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: ${({ isActive }) => 
      isActive ? 'rgba(100, 255, 218, 0.15)' : 'transparent'};
    border-radius: 8px;
    transition: all 0.4s ease;
  }

  &:hover::before {
    background: rgba(100, 255, 218, 0.15);
  }

  &::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: ${({ isActive }) => (isActive ? '60%' : '0%')};
    height: 2px;
    background: #64ffda;
    border-radius: 2px;
    transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  }

  &:hover::after {
    width: 60%;
  }

  ${({ isActive }) => isActive && css`
    animation: ${pulse} 2s infinite;
  `}
`;

export default Navbar;