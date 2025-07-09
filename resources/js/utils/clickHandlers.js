/**
 * Reusable click handler functions for the ToDo App
 * This module contains various button click handlers that can be reused across the application
 */

/**
 * Generic button click handler
 * @param {Event} event - The click event object
 * @param {string} message - Optional message to log
 */
export function handleMyButtonClick(event) {
  // Business logic here
  console.log('Button clicked!', event);
  
  // Optional: Prevent default behavior if needed
  // event.preventDefault();
  
  // Optional: Stop event propagation if needed
  // event.stopPropagation();
}

/**
 * Task-related button click handler
 * @param {Event} event - The click event object
 * @param {Object} taskData - Task data object
 */
export function handleTaskButtonClick(event, taskData = null) {
  console.log('Task button clicked!', event);
  
  if (taskData) {
    console.log('Task data:', taskData);
    // Add task-specific logic here
  }
  
  // Example: Add loading state
  const button = event.target;
  const originalText = button.textContent;
  button.textContent = 'Processing...';
  button.disabled = true;
  
  // Simulate async operation
  setTimeout(() => {
    button.textContent = originalText;
    button.disabled = false;
  }, 1000);
}

/**
 * Modal trigger button click handler
 * @param {Event} event - The click event object
 * @param {string} modalId - ID of the modal to open
 */
export function handleModalButtonClick(event, modalId) {
  console.log('Modal button clicked!', event);
  
  if (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      // If using Alpine.js, you might use Alpine's modal system
      // For now, we'll use a generic approach
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  }
}

/**
 * Form submission button click handler
 * @param {Event} event - The click event object
 * @param {string} formId - ID of the form to submit
 * @param {Object} options - Additional options for form submission
 */
export function handleFormSubmitButtonClick(event, formId, options = {}) {
  console.log('Form submit button clicked!', event);
  
  const form = document.getElementById(formId);
  if (!form) {
    console.error(`Form with ID "${formId}" not found`);
    return;
  }
  
  // Validate form before submission if validation function provided
  if (options.validateForm && typeof options.validateForm === 'function') {
    const isValid = options.validateForm(form);
    if (!isValid) {
      console.log('Form validation failed');
      return;
    }
  }
  
  // Add loading state
  const button = event.target;
  const originalText = button.textContent;
  button.textContent = options.loadingText || 'Submitting...';
  button.disabled = true;
  
  // Submit form
  form.submit();
}

/**
 * AJAX request button click handler
 * @param {Event} event - The click event object
 * @param {string} url - URL to send the request to
 * @param {Object} options - Request options (method, data, headers, etc.)
 */
export function handleAjaxButtonClick(event, url, options = {}) {
  console.log('AJAX button clicked!', event);
  
  const button = event.target;
  const originalText = button.textContent;
  
  // Add loading state
  button.textContent = options.loadingText || 'Loading...';
  button.disabled = true;
  
  // Default options
  const defaultOptions = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  };
  
  const requestOptions = { ...defaultOptions, ...options };
  
  // Use axios if available (since it's included in bootstrap.js)
  if (window.axios) {
    const axiosConfig = {
      method: requestOptions.method.toLowerCase(),
      url: url,
      data: requestOptions.data,
      headers: requestOptions.headers
    };
    
    window.axios(axiosConfig)
      .then(response => {
        console.log('AJAX request successful:', response);
        if (options.onSuccess && typeof options.onSuccess === 'function') {
          options.onSuccess(response);
        }
      })
      .catch(error => {
        console.error('AJAX request failed:', error);
        if (options.onError && typeof options.onError === 'function') {
          options.onError(error);
        }
      })
      .finally(() => {
        // Reset button state
        button.textContent = originalText;
        button.disabled = false;
      });
  } else {
    // Fallback to fetch API
    fetch(url, requestOptions)
      .then(response => response.json())
      .then(data => {
        console.log('AJAX request successful:', data);
        if (options.onSuccess && typeof options.onSuccess === 'function') {
          options.onSuccess(data);
        }
      })
      .catch(error => {
        console.error('AJAX request failed:', error);
        if (options.onError && typeof options.onError === 'function') {
          options.onError(error);
        }
      })
      .finally(() => {
        // Reset button state
        button.textContent = originalText;
        button.disabled = false;
      });
  }
}

/**
 * Confirmation dialog button click handler
 * @param {Event} event - The click event object
 * @param {string} message - Confirmation message
 * @param {Function} callback - Function to execute if confirmed
 */
export function handleConfirmationButtonClick(event, message, callback) {
  console.log('Confirmation button clicked!', event);
  
  const confirmed = confirm(message || 'Are you sure?');
  
  if (confirmed && callback && typeof callback === 'function') {
    callback(event);
  }
}

/**
 * Toggle button click handler (for switches, checkboxes, etc.)
 * @param {Event} event - The click event object
 * @param {string} targetId - ID of the element to toggle
 * @param {string} toggleClass - CSS class to toggle
 */
export function handleToggleButtonClick(event, targetId, toggleClass = 'hidden') {
  console.log('Toggle button clicked!', event);
  
  const targetElement = document.getElementById(targetId);
  if (targetElement) {
    targetElement.classList.toggle(toggleClass);
  }
  
  // Update button state if needed
  const button = event.target;
  const isActive = !targetElement.classList.contains(toggleClass);
  
  if (isActive) {
    button.classList.add('active');
  } else {
    button.classList.remove('active');
  }
}
