<template>
    <div class="product row">
        <div class="col-7">
            <div class="row">
                <span class="product_field-name">ID</span>
                <span>{{ product.id }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Title</span>
                <span class="product_value__truncate">{{ product.title }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Sales</span>
                <span>{{ sales }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Price</span>
                <span>{{ product.price }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Amount</span>
                <span>{{ product.amount }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Url</span>
                <span class="product_value__truncate"><a :href="product.url">{{ product.url }}</a></span>
            </div>
            <div class="row" v-if="product.description.trim()">
                <span class="product_field-name">Description</span>
                <span>{{ product.description }}</span>
            </div>
            <div class="row">
                <span class="product_field-name">Categories</span>
                <categories-links :categories="product.categories"></categories-links>
            </div>
        </div>
        <div class="col-5 product_image-column">
            <img :src="product.image" :alt="product.title" class="product_image"/>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ProductItemComponent',
    props: {
      product: Object
    },

    data: function () {
      const sales = this.product.offers.reduce((res, offer) => res + offer.sales, 0);

      return {
        sales
      };
    }
  }
</script>

<style lang="scss" scoped>
    .row {
        margin: 0;
    }

    .product_image-column {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product_image {
        max-width: 100%;
        max-height: 100%;
    }

    .product_field-name {
        color: gray;

        font-weight: 200;
        padding-right: 5px;

        &::after {
            content: ':';
        }
    }

    .product_value__truncate {
        display: inline-block;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        width: 90%;
    }
</style>
