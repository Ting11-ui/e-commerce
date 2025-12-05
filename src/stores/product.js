import axios from 'axios'
import { defineStore } from 'pinia'

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [],
    promotions: [],
    categories: [],
    products: [],
    cart: {} // Format: { productId: quantity }
  }),

  getters: {
    // 1. Get categories by group name
    getCategoriesByGroup: (state) => {
      return (groupName) => {
        return state.categories.filter((category) => category.group === groupName)
      }
    },

    // 2. Get products by group name
    getProductsByGroup: (state) => {
      return (groupName) => {
        const directGroupProducts = state.products.filter(
          (product) => product.group === groupName.toLowerCase()
        )

        if (directGroupProducts.length > 0) {
          return directGroupProducts
        }

        const categoryIds = state.categories
          .filter((category) => category.group === groupName)
          .map(cat => cat.id)

        return state.products.filter((product) =>
          categoryIds.includes(product.categoryId)
        )
      }
    },

    // 3. Get products by category ID
    getProductsByCategory: (state) => {
      return (categoryId) => {
        return state.products.filter((product) => product.categoryId === categoryId)
      }
    },

    // 4. Get popular products (countSold > 10)
    getPopularProducts: (state) => {
      return state.products.filter((product) => (product.countSold || 0) > 10)
    },

    // 5. Get quantity for a specific product
    getProductQuantity: (state) => {
      return (productId) => {
        return state.cart[productId] || 0
      }
    },

    // 6. Check if product is in cart
    isInCart: (state) => {
      return (productId) => {
        return !!state.cart[productId] && state.cart[productId] > 0
      }
    }
  },

  actions: {
    async loadData() {
      try {
        const [groups, promotions, categories, products] = await Promise.all([
          axios.get('http://localhost:3000/api/groups'),
          axios.get('http://localhost:3000/api/promotions'),
          axios.get('http://localhost:3000/api/categories'),
          axios.get('http://localhost:3000/api/products'),
        ])

        this.groups = groups.data
        this.promotions = promotions.data
        this.categories = categories.data
        this.products = products.data
      } catch (error) {
        console.error('❌ Failed to load product data:', error)
        console.error('Make sure your backend server is running on http://localhost:3000')
      }
    },

    // Add product to cart
    addToCart(productId) {
      if (!this.cart[productId]) {
        this.cart[productId] = 1
      }
    },

    // Increase product quantity
    incrementQuantity(productId) {
      if (this.cart[productId]) {
        this.cart[productId] += 1
      } else {
        this.cart[productId] = 1
      }
    },

    // Decrease product quantity
    decrementQuantity(productId) {
      if (this.cart[productId] && this.cart[productId] > 1) {
        this.cart[productId] -= 1
      } else {
        delete this.cart[productId]
      }
    }
  }

})

