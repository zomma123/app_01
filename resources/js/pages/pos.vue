<template>
  <div>
    <div class="row">
      <!-- ສ່ວນ​ສະ​ແດງ​ລາຍ​ການ​ຂາຍຂອງ​ສິນ​ຄ້າ -->
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <input
              type="text"
              class="form-control"
              placeholder="ຄົ້ນ​ຫາ....."
            />
          </div>
          <div class="row pt-3" style="overflow: auto; height: 73vh">
            <div class="col-md-2 mb-3">
              <div class="card pointer">
                <!--v-if--><img
                  class="card-img-top mb-1 image_size"
                  src="assets/img/1700451161.png"
                  alt="Card image cap"
                />
                <div class="text-center">
                  <span class="fw-bold">hhhh</span><br /><span
                    class="text_price"
                    >205,000 ກີບ
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ສ່ວນ​ສະ​ແດງ​ລາຍ​ການ​ທີ່​ເລືອກ -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <div class="mb-2">
              <label for="customer-name"> ຊື່​ລູກ​ຄ້າ: </label>
              <input
                type="text"
                class="form-control"
                placeholder="ປ້ອນ​ຊື່​ລູກ​ຄ້າ....."
              />
            </div>
            <div class="mb-2">
              <label for="customer-tel"> ເບີ​ໂທ: </label>
              <input
                type="text"
                class="form-control"
                placeholder="ປ້ອນ​ຊື່​ລູກ​ຄ້າ....."
              />
            </div>
            <div class="d-flex justify-content-between">
              <span> ຈຳ​ນວນ​ເງິນ​ທັງ​ໝົດ: </span>
              <span> 00000000 </span>
            </div>
            <div class="mt-2">
              <button
                type="button"
                class="btn rounded-pill btn-label-info"
                style="width: 100%"
              >
                ຊຳ​ລະ​ເງິນ
              </button>
            </div>
            <div style="overflow: auto; height: 50vh">
              <table class="table table-bordered text-center mt-3">
                <thead>
                  <tr>
                    <th class="fw-bold" style="width: 20px">ລຳດັບ</th>
                    <th class="fw-bold">ສິນຄ້າ</th>
                    <th class="fw-bold">ຈຳນວນ</th>
                    <th class="fw-bold">ລາຄາ</th>
                    <th class="fw-bold">
                      ລາຄາລວມ
                      <!-- (<i
                        class="bx bxs-x-circle pointer text-danger"
                      ></i
                      >) -->
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyApp1Pos",

  data() {
    return {};
  },

  mounted() {},

  methods: {},

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