<template>
  <div>
    <store-report/>

    <div class="row">
      <!-- ສ່ວນ​ສະ​ແດງ​ຂອງ ກ​ຣາ​ຟ -->
      <div class="col-md-12">
        <div class="card">
          <!-- <h3 class="card-header text-center fw-bold">
            ລາຍ​ງານການ​ເຄື່ອນ​ໄຫວ​ທຸ​ລະ​ກຳ
          </h3> -->
          <div class="d-flex justify-content-end p-2">
            <div class="btn-group me-2" role="group" aria-label="Basic example">
              <button
                type="button"
                class="btn btn-secondary"
                @click="month_type = 'm'"
              >
                <i class="bx bx-chevron-right" v-if="month_type == 'm'"></i>
                ເດືອນ
              </button>
              <button
                type="button"
                class="btn btn-info"
                @click="month_type = 'y'"
              >
                <i class="bx bx-chevron-right" v-if="month_type == 'y'"></i> ປີ
              </button>
            </div>
            <input
              type="date"
              class="form-control me-2"
              style="width: 150px"
              v-model="dmy"
            />
            <button
              type="button"
              class="btn rounded-pill btn-success"
              @click="getDataTran()"
              :disabled="disre"
            >
              ສະ​ແດງ​ການ​ເຄື່ອນ​ໄຫວ
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card mt-3">
          <month-chart
            :chartData="chdata"
            :chartOption="choption"
            :update="update_chart"
            :key="key"
            v-if="ShowChart"
          ></month-chart>
        </div>
      </div>

      <!-- ສ່ວນ​ສະ​ແດງ​ຂອງ report -->
      <div class="col-md-4 text-center" v-if="ShowChart">
        <div class="card mt-3">
          <div class="card-body">
            <h4>ລາຍ​ຮັບ</h4>
            <div class="text-end text-success">
              <span>{{ formatPrice(sum_income) }} ກີບ</span>
            </div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <h4>ລາຍ​ຈ່າຍ</h4>
            <div class="text-end text-danger">
              <span>{{ formatPrice(sum_expense) }} ກີບ</span>
            </div>
          </div>
        </div>

        <div class="card mt-3">
          <div class="card-body">
            <h4>ກຳ​ໄລ</h4>
            <div class="text-end text-primary">
              <span>{{ formatPrice(sum_profit) }} ກີບ</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import MonthChart from "../components/MonthChart.vue";
import moment from "moment";
export default {
  components: { moment },
  name: "MyApp1Report",

  data() {
    return {
      ShowChart: false,
      ReportData: [],
      month_type: "y",
      dmy: "",
      data_income: [],
      data_expense: [],
      chdata: [],
      choption: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                display: true,
                beginAtZero: false,
                callback: function (value, index, values) {
                  return (
                    Number(value)
                      .toFixed(0)
                      .replace(/./g, function (c, i, a) {
                        return i > 0 && c !== "." && (a.length - i) % 3 === 0
                          ? "," + c
                          : c;
                      }) + " ກີບ"
                  );
                },
              },
              gridLines: {
                show: true,
              },
            },
          ],
        },
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              return (
                Number(tooltipItem.yLabel)
                  .toFixed(0)
                  .replace(/./g, function (c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0
                      ? "," + c
                      : c;
                  }) + " ກີບ"
              );
            },
          },
          mode: "index",
          intersect: false,
        },
      },

      update_chart: null,
      key: 0,
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
    disre() {
      if (this.dmy == "") {
        return true;
      } else {
        return false;
      }
    },
  },

  methods: {
    getDataTran() {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post("api/report", {
            month_type: this.month_type,
            dmy: this.dmy,
          })
          .then((response) => {
            this.data_income = response.data.income;
            this.data_expense = response.data.expense;
            this.GenGrap();
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
    GenGrap() {
      this.ShowChart = true;

      if (this.month_type == "m") {
        this.key++;

        let re_income = [];
        let re_expense = [];
        let m = this.dmy.split("-")[1];
        let y = this.dmy.split("-")[0];

        let lastday = this.Getlastday(y, m);
        let chart_label = [];

        for (let i = 0; i < lastday; i++) {
          chart_label.push("ວັນທີ່ " + (i + 1));
        }

        //console.log(chart_label);

        re_income = this.Get_data_chart(lastday, this.data_income) || 0;
        re_expense = this.Get_data_chart(lastday, this.data_expense) || 0;

        this.chdata = {
          labels: chart_label,
          datasets: [
            {
              label: "ລາຍຮັບ",
              fill: false,
              borderColor: "#336600",
              data: re_income,
            },
            {
              label: "ລາຍຈ່າຍ",
              fill: false,
              borderColor: "#DC3912",
              data: re_expense,
            },
          ],
        };

        this.udate_chart = Math.floor(Math.random() * 100);
      } else if (this.month_type == "y") {
        this.key++;

        let re_income = [];
        let re_expense = [];
        let m = this.dmy.split("-")[1];
        let y = this.dmy.split("-")[0];

        //let lastday = this.Getlastday(y,m);
        let chart_label = [
          "ເດືອນ 1",
          "ເດືອນ 2",
          "ເດືອນ 3",
          "ເດືອນ 4",
          "ເດືອນ 5",
          "ເດືອນ 6",
          "ເດືອນ 7",
          "ເດືອນ 8",
          "ເດືອນ 9",
          "ເດືອນ 10",
          "ເດືອນ 11",
          "ເດືອນ 12",
        ];

        //console.log(chart_label);

        re_income = this.Get_data_chart_y(12, this.data_income) || 0;
        re_expense = this.Get_data_chart_y(12, this.data_expense) || 0;

        this.chdata = {
          labels: chart_label,
          datasets: [
            {
              label: "ລາຍຮັບ",
              fill: false,
              borderColor: "#336600",
              data: re_income,
            },
            {
              label: "ລາຍຈ່າຍ",
              fill: false,
              borderColor: "#DC3912",
              data: re_expense,
            },
          ],
        };

        this.udate_chart = Math.floor(Math.random() * 100);
      }
    },
    Getlastday(y, m) {
      let dd = new Date(y, m, 0).getDate();
      console.log("ວັນທີ່ສຸດທ້າຍ ຂອງເດືອນ:" + dd);
      return dd;
    },
    Getday(value) {
      return moment(value).format("DD");
    },
    Getmonth(value) {
      return moment(value).format("MM");
    },
    Get_data_chart(date, data) {
      ///  console.log(data)
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let day = this.Getday(data[y].created_at);
          new_db_in.push({ price: data[y].price, day: day });
        }
      }
      // console.log(new_db_in)

      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.day === c.day);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);

      //console.log(update_db_in)
      for (let i = 0; i < date; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].day == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }

      //console.log(databack)

      return databack;
    },
    Get_data_chart_y(monthchart, data) {
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let month = this.Getmonth(data[y].created_at);
          new_db_in.push({ price: data[y].price, month: month });
        }
      }

      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.month == c.month);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);

      for (let i = 0; i < monthchart; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].month == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }

      return databack;
    },

    // ເພີ່ມ​ຈຸດໃນ​ຕາ​ຕະ​ລາງ
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
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