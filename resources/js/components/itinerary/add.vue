<template>
  <div>
    <h3 class="page-title">Thêm dịch vụ</h3>
    <p class="text-muted mb-3">
      Mỗi dịch vụ tương ứng một tab trên trang chủ (VD: Ngày, Đêm).
    </p>

    <ItineraryForm :form="objData" />

    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="save">Lưu</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import ItineraryForm from "./components/Form.vue";
import { defaultItinerary, validateItinerary } from "./helpers";

export default {
  name: "addItinerary",
  components: { ItineraryForm },
  data() {
    return {
      objData: defaultItinerary(),
    };
  },
  methods: {
    ...mapActions(["saveItinerary", "loadings"]),
    save() {
      const error = validateItinerary(this.objData);
      if (error) {
        this.$error(error);
        return;
      }

      this.loadings(true);
      this.saveItinerary(this.objData)
        .then(() => {
          this.loadings(false);
          this.$success("Thêm thành công");
          this.$router.push({ name: "listItinerary" });
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Thêm thất bại");
        });
    },
  },
};
</script>
