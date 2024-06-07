const { searchCoupons, redeemCoupon, setDealAlert } = require('./extension');
const mockBrowserAPI = {
  tabs: {
    create: jest.fn(),
  },
  notifications: {
    create: jest.fn(),
  },
  storage: {
    local: {
      get: jest.fn(),
      set: jest.fn(),
    },
  },
};

// Set up the mock browser environment
global.browser = mockBrowserAPI;

// Import the functions or modules to be tested after setting up the mock environment
const { searchCoupons, redeemCoupon, setDealAlert } = require('./extension');

describe('Extension', () => {
  describe('searchCoupons', () => {
    it('should search for coupons based on keywords or categories', () => {
      // Call the function to be tested
      const searchResults = searchCoupons('electronics');

      // Verify that search results are returned and match the expected format
      expect(searchResults).toBeDefined();
      expect(Array.isArray(searchResults)).toBe(true);
      expect(searchResults.length).toBeGreaterThan(0);
      expect(searchResults[0]).toHaveProperty('title');
      expect(searchResults[0]).toHaveProperty('discount');
      expect(searchResults[0]).toHaveProperty('expirationDate');
    });
  });

  describe('redeemCoupon', () => {
    it('should redeem a coupon and apply the discount during checkout', () => {
      // Call the function to be tested
      const couponCode = 'SAVE10';
      const discountApplied = redeemCoupon(couponCode);

      // Verify that the discount is applied correctly
      expect(discountApplied).toBe(true);
    });
  });

  describe('setDealAlert', () => {
    it('should set up a deal alert for a specific retailer or category', () => {
      // Call the function to be tested
      const retailer = 'Amazon';
      const category = 'Electronics';
      const dealAlertSet = setDealAlert(retailer, category);

      // Verify that the deal alert is set up successfully
      expect(dealAlertSet).toBe(true);
    });
  });
});
