import React from 'react';

const Footer = () => {
  return (
    <footer style={styles.footer}>
      <p>© 2023 My React App. All rights reserved.</p>
    </footer>
  );
};

const styles = {
  footer: {
    backgroundColor: '#333',
    color: 'white',
    textAlign: 'center',
    padding: '1rem',
    position: 'fixed',
    bottom: 0,
    width: '100%',
  }
};

export default Footer;