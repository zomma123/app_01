<template>
    <div>
        <h1>POS</h1>
    </div>
</template>

<script>
export default {
    name: 'MyApp1Pos',

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