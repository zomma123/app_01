<template>
    <div>
        <h1>
            report
        </h1>
    </div>
</template>

<script>
export default {
    name: 'MyApp1Report',

    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },

    beforeRouteEnter(to, from, next) {
    if (window.Laravel.isLogin) {
      next();
    } else {
      window.location.href = "/login";
    }
  },
};
</script>

<style lang="scss" scoped>

</style>