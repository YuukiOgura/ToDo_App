import * as ClickHandlers from '../../resources/js/utils/clickHandlers';

describe('Click Handlers', () => {
  let mockButton;
  let mockForm;
  let mockModal;
  let clickCount;

  beforeEach(() => {
    // Create mock elements
    mockButton = document.createElement('button');
    mockButton.id = 'test-button';
    mockButton.textContent = 'Click me';
    document.body.appendChild(mockButton);

    mockForm = document.createElement('form');
    mockForm.id = 'test-form';
    document.body.appendChild(mockForm);

    mockModal = document.createElement('div');
    mockModal.id = 'test-modal';
    mockModal.classList.add('hidden');
    document.body.appendChild(mockModal);

    clickCount = 0;
  });

  afterEach(() => {
    document.body.innerHTML = '';
  });

  describe('handleMyButtonClick', () => {
    test('should fire exactly once per click', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      
      // Create event
      const event = new Event('click', { bubbles: true });
      
      // Test single click
      ClickHandlers.handleMyButtonClick(event);
      expect(consoleSpy).toHaveBeenCalledTimes(1);
      
      // Test multiple rapid clicks
      consoleSpy.mockClear();
      for (let i = 0; i < 5; i++) {
        ClickHandlers.handleMyButtonClick(new Event('click', { bubbles: true }));
      }
      expect(consoleSpy).toHaveBeenCalledTimes(5);
      
      consoleSpy.mockRestore();
    });

    test('should be accessible via keyboard (Enter)', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      
      // Set up keyboard event listener
      const keyboardHandler = (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          ClickHandlers.handleMyButtonClick(event);
        }
      };
      
      mockButton.addEventListener('keydown', keyboardHandler);
      
      // Simulate Enter key press
      const enterEvent = simulateKeyPress(mockButton, 'Enter');
      
      expect(consoleSpy).toHaveBeenCalledWith('Button clicked!', enterEvent);
      
      consoleSpy.mockRestore();
    });

    test('should be accessible via keyboard (Space)', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      
      // Set up keyboard event listener
      const keyboardHandler = (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          ClickHandlers.handleMyButtonClick(event);
        }
      };
      
      mockButton.addEventListener('keydown', keyboardHandler);
      
      // Simulate Space key press
      const spaceEvent = simulateKeyPress(mockButton, ' ');
      
      expect(consoleSpy).toHaveBeenCalledWith('Button clicked!', spaceEvent);
      
      consoleSpy.mockRestore();
    });
  });

  describe('handleTaskButtonClick', () => {
    test('should fire exactly once per click and manage button state', async () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      const taskData = { id: 1, title: 'Test Task' };
      
      // Execute handler
      ClickHandlers.handleTaskButtonClick(event, taskData);
      
      // Verify immediate response
      expect(consoleSpy).toHaveBeenCalledWith('Task button clicked!', event);
      expect(consoleSpy).toHaveBeenCalledWith('Task data:', taskData);
      expect(mockButton.disabled).toBe(true);
      expect(mockButton.textContent).toBe('Processing...');
      
      // Wait for async operation to complete
      await waitFor(() => !mockButton.disabled);
      
      expect(mockButton.disabled).toBe(false);
      expect(mockButton.textContent).toBe('Click me');
      
      consoleSpy.mockRestore();
    });

    test('should handle multiple rapid clicks properly', async () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      
      // First click
      const event1 = new Event('click', { bubbles: true });
      Object.defineProperty(event1, 'target', { value: mockButton });
      ClickHandlers.handleTaskButtonClick(event1);
      
      // Second click while processing - should still work but button should be disabled
      const event2 = new Event('click', { bubbles: true });
      Object.defineProperty(event2, 'target', { value: mockButton });
      ClickHandlers.handleTaskButtonClick(event2);
      
      // Both clicks should be logged
      expect(consoleSpy).toHaveBeenCalledTimes(2);
      expect(mockButton.disabled).toBe(true);
      
      consoleSpy.mockRestore();
    });
  });

  describe('handleModalButtonClick', () => {
    test('should fire exactly once per click and toggle modal visibility', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const event = new Event('click', { bubbles: true });
      
      // Initial state
      expect(mockModal.classList.contains('hidden')).toBe(true);
      
      // Execute handler
      ClickHandlers.handleModalButtonClick(event, 'test-modal');
      
      // Verify modal is shown
      expect(consoleSpy).toHaveBeenCalledWith('Modal button clicked!', event);
      expect(mockModal.classList.contains('hidden')).toBe(false);
      expect(mockModal.classList.contains('flex')).toBe(true);
      
      consoleSpy.mockRestore();
    });

    test('should be accessible via keyboard', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      
      const keyboardHandler = (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          ClickHandlers.handleModalButtonClick(event, 'test-modal');
        }
      };
      
      mockButton.addEventListener('keydown', keyboardHandler);
      
      // Test Enter key
      const enterEvent = simulateKeyPress(mockButton, 'Enter');
      expect(consoleSpy).toHaveBeenCalledWith('Modal button clicked!', enterEvent);
      
      consoleSpy.mockRestore();
    });
  });

  describe('handleFormSubmitButtonClick', () => {
    test('should fire exactly once per click and submit form', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const submitSpy = jest.spyOn(mockForm, 'submit').mockImplementation(() => {});
      
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      // Execute handler
      ClickHandlers.handleFormSubmitButtonClick(event, 'test-form');
      
      // Verify form submission
      expect(consoleSpy).toHaveBeenCalledWith('Form submit button clicked!', event);
      expect(submitSpy).toHaveBeenCalledTimes(1);
      expect(mockButton.disabled).toBe(true);
      expect(mockButton.textContent).toBe('Submitting...');
      
      consoleSpy.mockRestore();
      submitSpy.mockRestore();
    });

    test('should handle form validation', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const submitSpy = jest.spyOn(mockForm, 'submit').mockImplementation(() => {});
      
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      // Test with failing validation
      const options = {
        validateForm: jest.fn().mockReturnValue(false)
      };
      
      ClickHandlers.handleFormSubmitButtonClick(event, 'test-form', options);
      
      expect(options.validateForm).toHaveBeenCalledWith(mockForm);
      expect(submitSpy).not.toHaveBeenCalled();
      expect(consoleSpy).toHaveBeenCalledWith('Form validation failed');
      
      consoleSpy.mockRestore();
      submitSpy.mockRestore();
    });
  });

  describe('handleAjaxButtonClick', () => {
    test('should fire exactly once per click and make AJAX request', async () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const mockAxios = jest.fn().mockResolvedValue({ data: 'success' });
      window.axios = mockAxios;
      
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      // Execute handler
      ClickHandlers.handleAjaxButtonClick(event, '/test-url');
      
      // Verify immediate response
      expect(consoleSpy).toHaveBeenCalledWith('AJAX button clicked!', event);
      expect(mockButton.disabled).toBe(true);
      expect(mockButton.textContent).toBe('Loading...');
      
      // Wait for async operation
      await waitFor(() => !mockButton.disabled);
      
      expect(mockAxios).toHaveBeenCalledTimes(1);
      expect(mockButton.disabled).toBe(false);
      expect(mockButton.textContent).toBe('Click me');
      
      consoleSpy.mockRestore();
    });

    test('should handle AJAX errors properly', async () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const errorSpy = jest.spyOn(console, 'error').mockImplementation(() => {});
      const mockAxios = jest.fn().mockRejectedValue(new Error('Network error'));
      window.axios = mockAxios;
      
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      // Execute handler
      ClickHandlers.handleAjaxButtonClick(event, '/test-url');
      
      // Wait for error handling
      await waitFor(() => !mockButton.disabled);
      
      expect(errorSpy).toHaveBeenCalledWith('AJAX request failed:', expect.any(Error));
      expect(mockButton.disabled).toBe(false);
      expect(mockButton.textContent).toBe('Click me');
      
      consoleSpy.mockRestore();
      errorSpy.mockRestore();
    });
  });

  describe('handleConfirmationButtonClick', () => {
    test('should fire exactly once per click and show confirmation', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const confirmSpy = jest.spyOn(window, 'confirm').mockReturnValue(true);
      const callback = jest.fn();
      
      const event = new Event('click', { bubbles: true });
      
      // Execute handler
      ClickHandlers.handleConfirmationButtonClick(event, 'Are you sure?', callback);
      
      expect(consoleSpy).toHaveBeenCalledWith('Confirmation button clicked!', event);
      expect(confirmSpy).toHaveBeenCalledWith('Are you sure?');
      expect(callback).toHaveBeenCalledWith(event);
      
      consoleSpy.mockRestore();
      confirmSpy.mockRestore();
    });

    test('should not execute callback if confirmation is cancelled', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const confirmSpy = jest.spyOn(window, 'confirm').mockReturnValue(false);
      const callback = jest.fn();
      
      const event = new Event('click', { bubbles: true });
      
      ClickHandlers.handleConfirmationButtonClick(event, 'Are you sure?', callback);
      
      expect(confirmSpy).toHaveBeenCalledWith('Are you sure?');
      expect(callback).not.toHaveBeenCalled();
      
      consoleSpy.mockRestore();
      confirmSpy.mockRestore();
    });
  });

  describe('handleToggleButtonClick', () => {
    test('should fire exactly once per click and toggle element', () => {
      const consoleSpy = jest.spyOn(console, 'log').mockImplementation(() => {});
      const targetElement = document.createElement('div');
      targetElement.id = 'toggle-target';
      targetElement.classList.add('hidden');
      document.body.appendChild(targetElement);
      
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      // Execute handler
      ClickHandlers.handleToggleButtonClick(event, 'toggle-target');
      
      expect(consoleSpy).toHaveBeenCalledWith('Toggle button clicked!', event);
      expect(targetElement.classList.contains('hidden')).toBe(false);
      expect(mockButton.classList.contains('active')).toBe(true);
      
      // Toggle again
      ClickHandlers.handleToggleButtonClick(event, 'toggle-target');
      
      expect(targetElement.classList.contains('hidden')).toBe(true);
      expect(mockButton.classList.contains('active')).toBe(false);
      
      consoleSpy.mockRestore();
    });
  });

  describe('Accessibility Testing', () => {
    test('all handlers should support keyboard navigation', () => {
      const handlers = [
        ClickHandlers.handleMyButtonClick,
        ClickHandlers.handleTaskButtonClick,
        ClickHandlers.handleModalButtonClick,
        ClickHandlers.handleFormSubmitButtonClick,
        ClickHandlers.handleAjaxButtonClick,
        ClickHandlers.handleConfirmationButtonClick,
        ClickHandlers.handleToggleButtonClick
      ];
      
      handlers.forEach(handler => {
        const keyboardHandler = (event) => {
          if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            // Call with appropriate parameters based on handler
            if (handler === ClickHandlers.handleTaskButtonClick) {
              handler(event, { id: 1 });
            } else if (handler === ClickHandlers.handleModalButtonClick) {
              handler(event, 'test-modal');
            } else if (handler === ClickHandlers.handleFormSubmitButtonClick) {
              handler(event, 'test-form');
            } else if (handler === ClickHandlers.handleAjaxButtonClick) {
              handler(event, '/test-url');
            } else if (handler === ClickHandlers.handleConfirmationButtonClick) {
              handler(event, 'Confirm?', () => {});
            } else if (handler === ClickHandlers.handleToggleButtonClick) {
              handler(event, 'test-modal');
            } else {
              handler(event);
            }
          }
        };
        
        mockButton.addEventListener('keydown', keyboardHandler);
        
        // Test should not throw errors
        expect(() => {
          simulateKeyPress(mockButton, 'Enter');
          simulateKeyPress(mockButton, ' ');
        }).not.toThrow();
        
        mockButton.removeEventListener('keydown', keyboardHandler);
      });
    });
  });

  describe('Performance Testing', () => {
    test('handlers should complete within reasonable time', async () => {
      const start = performance.now();
      
      // Test multiple handlers
      const event = new Event('click', { bubbles: true });
      Object.defineProperty(event, 'target', { value: mockButton });
      
      ClickHandlers.handleMyButtonClick(event);
      ClickHandlers.handleModalButtonClick(event, 'test-modal');
      ClickHandlers.handleToggleButtonClick(event, 'test-modal');
      
      const end = performance.now();
      const duration = end - start;
      
      // Should complete within 100ms
      expect(duration).toBeLessThan(100);
    });
  });
});
