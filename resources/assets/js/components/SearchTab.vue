<template>
    <div>
        <div class="form-row search-box">
            <div class="col-4 offset-4">
                <input v-model="query" type="text" class="form-control" placeholder="Type here...">
            </div>
        </div>

        <div v-if="isError" class="text-center error-msg">Error occurred. See console</div>
        <products-list :products="result" v-else></products-list>
    </div>
</template>

<script>
  import { debounce } from 'underscore';

  const API_URL = window.location.href + '/api/search/:query';

  export default {
    name: 'SearchTab',

    data: function () {
      return {
        result: [],
        isError: false,
        query: ''
      }
    },

    methods: {
      search: function (query) {
        if (query.length === 0) {
          this.result = [];
          return;
        }

        this.isError = false;

        fetch(API_URL.replace(':query', query))
          .then(res => res.json())
          .then(products => {
            this.result = products;
          })
          .catch(e => {
            console.error(e);
            this.isError = true;
            this.result = [];
          });
      }
    },

    watch: {
      query: debounce(function (value) {
        this.search(value.trim());
      }, 500)
    }
  }
</script>

<style lang="scss" scoped>
    .search-box {
        padding-top: 20px;
    }

    .error-msg {
        padding-top: 20px;
        color: red;
    }
</style>
