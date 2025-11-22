import React from 'react';
import Navbar from './Navbar';
import Footer from './Footer';

const Layout = ({ children }) => {
  return (
    <div style={styles.layout}>
      <Navbar />
      <main style={styles.main}>
        {children}
      </main>
     
    </div>
  );
};

const styles = {
  layout: {
    display: 'flex',
    flexDirection: 'column',
    minHeight: '100vh',
  },
  main: {
    flex: 1,
    padding: '2rem',
    marginBottom: '60px', // To prevent footer from overlapping content
  }
};

export default Layout;