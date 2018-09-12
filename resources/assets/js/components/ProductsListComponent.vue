<template>
    <div class="product-list">
        <div v-if="products.length === 0" class="text-center">
            <span>No products found</span>
        </div>
        <div v-else>
            <product-item
                    v-for="product in products"
                    :product="product"
                    :key="product.id"
                    class="product-line"/>
        </div>

    </div>
</template>

<script>
  export default {
    name: 'ProductsListComponent',
    props: {
      products: Array
    }
  }
</script>

<style lang="scss" scoped>
    .product-list {
        padding-top: 20px;
    }

    .product-line:not(:first-child) {
        padding-top: 20px;
    }
</style>
