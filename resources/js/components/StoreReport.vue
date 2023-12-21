<template>
  <div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-6 mb-4 te">
        <div class="card">
          <div class="card-body pb-0 text-center">
            <span class="d-block fw-medium fw-bold"> ລາຍ​ຮັບ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between text-success">
            <i class='bx bx-trending-up'></i>
            <span>{{ formatPrice(sum_income) }} ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0 text-center">
            <span class="d-block fw-medium fw-bold"> ລາຍ​ຈ່າຍ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between text-danger">
            <i class='bx bx-trending-down'></i>
            <span>{{ formatPrice(sum_expense) }} ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0 text-center">
            <span class="d-block fw-medium fw-bold"> ກ​ຳ​ໄລ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between text-info">
            <i class='bx bxs-objects-vertical-bottom'></i>
            <span>{{ formatPrice(sum_profit) }} ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0 text-center">
            <span class="d-block fw-medium fw-bold"> ສະ​ຕ໋ອກ​ສິນ​ຄ້າ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between text-primary">
            <i class='bx bx-slideshow'></i>
            <span>{{ formatPrice(sum_store) }} ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App01StoreReport",

  data() {
    return {
      data_income: [],
      data_expense: [],
      data_store: [],
    };
  },

  mounted() {},
  computed: {
    sum_income() {
      return this.data_income.reduce((num, item) => num + item.price, 0);
    },
    sum_expense() {
      return this.data_expense.reduce((num, item) => num + item.price, 0);
    },
    sum_profit() {
      return this.sum_income - this.sum_expense;
    },
    sum_store() {
      return this.data_store.reduce((num, item) => num + item.amount, 0);
    },
  },

  methods: {
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    GetData() {
      this.$axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          this.$axios
            .get(`api/report/dashgrap`)
            .then((response) => {
              this.data_income = response.data.income;
              this.data_expense = response.data.expense;
              this.data_store = response.data.store;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          console.log(error.response.status);
        });
    },
  },

  created() {
    this.GetData();
  },
};
</script>

<style lang="scss" scoped>
</style>