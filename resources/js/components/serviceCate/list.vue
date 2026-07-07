<template>
  <!-- partial -->
  <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Danh mục trải nghiệm</h4>
              <p class="card-description">Thêm mới hoặc sửa chửa danh mục trải nghiệm</p>
              <vs-button
                type="gradient"
                style="float:right;"
                :disabled="!$hasPermission('service.create')"
                @click="$goIfAllowed('service.create', { name: 'add_category_service' }, 'Bạn không có quyền thêm mới danh mục trải nghiệm.')"
              >Thêm mới</vs-button>
              <vs-table :data="list">
                <template slot="thead">
                  <vs-th style="width:56px">Kéo</vs-th>
                  <vs-th>ID</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Giá</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr
                    :key="tr.id"
                    v-for="(tr, indextr) in data"
                    :class="{ 'service-cate-row--dragging': draggingId === tr.id }"
                    :draggable="$hasPermission('service.update') && !isSorting"
                    @dragstart.native="onDragStart(indextr, tr.id)"
                    @dragover.native.prevent
                    @drop.native="onDrop(indextr)"
                    @dragend.native="onDragEnd"
                  >
                    <vs-td :data="tr.id">
                      <i class="fa fa-bars service-cate-drag-handle" aria-hidden="true"></i>
                    </vs-td>
                    <vs-td :data="tr.id">{{tr.id}}</vs-td>
                    <vs-td :data="tr.name">{{tr.name}}</vs-td>
                    <vs-td :data="tr.price">{{ tr.price || '—' }}</vs-td>
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'edit_category_service',params:{id:tr.id}}">
                        <vs-button
                          vs-type="gradient"
                          size="lagre"
                          color="success" 
                          icon="edit"
                        ></vs-button>
                      </router-link>
                      <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDestroy(tr.id)"></vs-button>
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
import ModalAdd from "../../components/layouts/modal/category/add";

import { mapActions } from "vuex";
export default {
  data: () => ({
    keyword: null,
    popupActivo: false,
    list: [],
    timer:0,
    id_item :'',
    dragStartIndex: null,
    draggingId: null,
    isSorting: false
  }),
  components: {
    ModalAdd
  },
  computed: {
    
  },
  methods: {
    ...mapActions(["listCateService","destroyCateService", "sortCateService", "loadings"]),
    listCategory() {
      this.loadings(true);
      this.listCateService({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
        });
    },
    destroy(){
      this.loadings(true);
      this.destroyCateService({id:this.id_item})
      .then(response => {
        this.listCategory()
        this.loadings(false);
        this.$success('Xóa danh mục thành công');
      });
    },
    confirmDestroy(id){
      this.id_item = id;
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa danh mục này',
        accept:this.destroy
      })
    },
    onDragStart(index, id) {
      if (!this.$hasPermission('service.update')) {
        this.$error('Bạn không có quyền cập nhật thứ tự hiển thị.');
        return;
      }
      this.dragStartIndex = index;
      this.draggingId = id;
    },
    onDragEnd() {
      this.dragStartIndex = null;
      this.draggingId = null;
    },
    async onDrop(dropIndex) {
      if (this.dragStartIndex === null || this.dragStartIndex === dropIndex || this.isSorting) {
        this.onDragEnd();
        return;
      }

      const reordered = [...this.list];
      const [movedItem] = reordered.splice(this.dragStartIndex, 1);
      reordered.splice(dropIndex, 0, movedItem);
      this.list = reordered;
      this.onDragEnd();

      this.isSorting = true;
      this.loadings(true);
      try {
        await this.sortCateService({ ids: this.list.map(item => item.id) });
        this.$success('Đã cập nhật vị trí hiển thị.');
      } catch (error) {
        this.$error('Không thể cập nhật thứ tự. Vui lòng thử lại.');
        this.listCategory();
      } finally {
        this.isSorting = false;
        this.loadings(false);
      }
    }
  },
  mounted() {
    this.listCategory()
  }
};
</script>
<style>
.service-cate-drag-handle {
  cursor: move;
  color: #999;
}

.service-cate-row--dragging {
  opacity: 0.55;
}
</style>