<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách hải trình</h4>
            <vs-button
              type="gradient"
              style="float: right"
              @click="$router.push({ name: 'addItinerary' })"
            >
              Thêm mới
            </vs-button>
            <vs-input
              icon="search"
              placeholder="Tìm theo tên tab"
              v-model="keyword"
              @keyup="searchItineraries"
            />
            <vs-table stripe :data="list" max-items="10" pagination>
              <template slot="thead">
                <vs-th>Ảnh</vs-th>
                <vs-th>Tên tab</vs-th>
                <vs-th>Thứ tự</vs-th>
                <vs-th>Trạng thái</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{ data }">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td>
                    <vs-avatar
                      size="70px"
                      :src="tr.map_image || tr.featured_image"
                    />
                  </vs-td>
                  <vs-td>{{ tr.name }}</vs-td>
                  <vs-td>{{ tr.sort }}</vs-td>
                  <vs-td>{{ tr.status == 1 ? "Hiện" : "Ẩn" }}</vs-td>
                  <vs-td>
                    <router-link :to="{ name: 'editItinerary', params: { id: tr.id } }">
                      <vs-button
                        vs-type="gradient"
                        size="lagre"
                        color="success"
                        icon="edit"
                      ></vs-button>
                    </router-link>
                    <vs-button
                      vs-type="gradient"
                      size="lagre"
                      color="red"
                      icon="delete_forever"
                      @click="confirmDestroy(tr.id)"
                    ></vs-button>
                  </vs-td>
                </vs-tr>
              </template>
            </vs-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "listItinerary",
  data() {
    return {
      list: [],
      keyword: "",
      id_item: "",
    };
  },
  methods: {
    ...mapActions(["listItinerary", "loadings", "deleteItinerary"]),
    listItineraries() {
      this.loadings(true);
      this.listItinerary({ keyword: this.keyword })
        .then((response) => {
          this.loadings(false);
          this.list = response.data || [];
        })
        .catch(() => {
          this.loadings(false);
          this.list = [];
        });
    },
    searchItineraries() {
      this.listItineraries();
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: "Bạn có chắc chắn",
        text: "Bạn sẽ xóa hải trình này?",
        accept: this.destroy,
      });
    },
    destroy() {
      this.loadings(true);
      this.deleteItinerary({ id: this.id_item })
        .then(() => {
          this.loadings(false);
          this.$success("Xóa thành công");
          this.listItineraries();
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Xóa thất bại");
        });
    },
  },
  mounted() {
    this.listItineraries();
  },
};
</script>
