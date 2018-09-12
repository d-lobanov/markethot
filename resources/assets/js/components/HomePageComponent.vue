<template>
    <div>
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <span class="nav-link"
                      :class="{ active: tab === 'top'}"
                      @click="tab = 'top'">Top</span>
            </li>
            <li class="nav-item">
                <span class="nav-link"
                      :class="{ active: tab === 'search'}"
                      @click="tab = 'search'">Search</span>
            </li>
        </ul>
        <div v-show="tab === 'top'">
            <products-list :products="bestSelling"></products-list>
        </div>
        <div v-show="tab === 'search'">
            <search-tab></search-tab>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'HomePageComponent',
    props: {
      bestSelling: Array
    },

    data: function () {
      return {
        tab: 'top'
      };
    },
  }
</script>
