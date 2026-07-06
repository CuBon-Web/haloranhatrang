<template>
  <div>
    <h3 class="page-title">Sửa dịch vụ</h3>

    <ItineraryForm v-if="loaded" :form="objData" />

    <div class="row fixxed" v-if="loaded">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="save">Cập nhật</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import ItineraryForm from "./components/Form.vue";
import { defaultItinerary, normalizeItinerary, validateItinerary } from "./helpers";

export default {
  name: "editItinerary",
  components: { ItineraryForm },
  data() {
    return {
      loaded: false,
      objData: defaultItinerary(),
    };
  },
  methods: {
    ...mapActions(["saveItinerary", "detailItinerary", "loadings"]),
    load() {
      this.loadings(true);
      this.detailItinerary({ id: this.$route.params.id })
        .then((response) => {
          this.loadings(false);
          this.objData = normalizeItinerary(response.data || {}, 0);
          this.loaded = true;
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Không tải được dữ liệu");
        });
    },
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
          this.$success("Cập nhật thành công");
          this.$router.push({ name: "listItinerary" });
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Cập nhật thất bại");
        });
    },
  },
  mounted() {
    this.load();
  },
};
</script>
