// Jest setup file
import '@testing-library/jest-dom';

// Mock window.axios for testing
global.axios = {
  request: jest.fn(),
  get: jest.fn(),
  post: jest.fn(),
  put: jest.fn(),
  delete: jest.fn(),
  patch: jest.fn(),
  head: jest.fn(),
  options: jest.fn(),
  defaults: {
    headers: {
      common: {}
    }
  }
};

// Mock window.Alpine for testing
global.Alpine = {
  start: jest.fn(),
  data: jest.fn(),
  store: jest.fn()
};

// Mock console methods for cleaner test output
beforeEach(() => {
  jest.clearAllMocks();
  
  // Reset DOM
  document.body.innerHTML = '';
  
  // Reset any global state
  if (window.ClickHandlers) {
    // Clear any cached references
    delete window.ClickHandlers;
  }
});

// Helper function to simulate keyboard events
global.simulateKeyPress = (element, key, options = {}) => {
  const event = new KeyboardEvent('keydown', {
    key,
    code: key === 'Enter' ? 'Enter' : key === ' ' ? 'Space' : key,
    keyCode: key === 'Enter' ? 13 : key === ' ' ? 32 : 0,
    which: key === 'Enter' ? 13 : key === ' ' ? 32 : 0,
    bubbles: true,
    cancelable: true,
    ...options
  });
  element.dispatchEvent(event);
  return event;
};

// Helper function to wait for async operations
global.waitFor = (callback, timeout = 1000) => {
  return new Promise((resolve, reject) => {
    const start = Date.now();
    const check = () => {
      try {
        const result = callback();
        if (result) {
          resolve(result);
        } else if (Date.now() - start > timeout) {
          reject(new Error('Timeout waiting for condition'));
        } else {
          setTimeout(check, 10);
        }
      } catch (error) {
        if (Date.now() - start > timeout) {
          reject(error);
        } else {
          setTimeout(check, 10);
        }
      }
    };
    check();
  });
};
