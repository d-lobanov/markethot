<template>
    <div>
        <span v-for="(category, index) in categories"
              :key="category.id">
            <a :href="link(category)">{{ category.title }}</a><span v-if="index !== categories.length - 1">, </span>
        </span>
    </div>
</template>

<script>
  export default {
    name: 'CategoriesLinksComponent',
    props: {
      categories: Array
    },

    methods: {
      link: category => '/category/' + category.alias
    }
  }
</script>

