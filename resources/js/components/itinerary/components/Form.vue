<template>
  <div class="itinerary-form">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <crm-form-section title="Thông tin hải trình">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ảnh bản đồ</label>
                    <image-upload
                      type="avatar"
                      v-model="form.map_image"
                      :title="'itinerary-map'"
                    ></image-upload>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <image-upload
                      type="avatar"
                      v-model="form.featured_image"
                      :title="'itinerary-featured'"
                    ></image-upload>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Tên tab <span class="text-danger">*</span></label>
                <vs-input
                  class="w-100"
                  v-model="form.name"
                  placeholder="VD: Ngày, Đêm"
                />
              </div>

              <div class="form-group">
                <label>Mô tả ngắn</label>
                <vs-textarea v-model="form.short_description" rows="3" />
              </div>

              <div class="form-group">
                <label>Nội dung</label>
                <TinyMce v-model="form.content" />
              </div>
            </crm-form-section>

            <crm-form-section title="Lộ trình từng ngày">
              <div
                v-for="(day, dayKey) in form.days"
                :key="'day-' + dayKey"
                class="itinerary-day-item"
              >
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <strong>Ngày #{{ dayKey + 1 }}</strong>
                  <label
                    v-if="form.days.length > 1"
                    class="itinerary-day-item__remove"
                    title="Xóa ngày"
                    @click="removeDay(dayKey)"
                  >
                    <vs-icon icon="clear"></vs-icon>
                  </label>
                </div>
                <div class="form-group">
                  <label>Tên <span class="text-danger">*</span></label>
                  <vs-input
                    class="w-100"
                    v-model="day.name"
                    placeholder="VD: Ngày 1 - Vịnh Nha Trang"
                  />
                </div>
                <div class="form-group">
                  <label>Nội dung</label>
                  <TinyMce v-model="day.content" />
                </div>
              </div>
              <vs-button color="success" type="border" size="small" @click="addDay">
                <vs-icon icon="add"></vs-icon> Thêm ngày
              </vs-button>
            </crm-form-section>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <crm-form-section title="Thiết lập">
              <div class="form-group">
                <label>Thứ tự</label>
                <vs-input type="number" v-model="form.sort" class="w-100" />
              </div>
              <div class="form-group">
                <label>Trạng thái</label>
                <vs-select v-model="form.status">
                  <vs-select-item value="1" text="Hiện" />
                  <vs-select-item value="0" text="Ẩn" />
                </vs-select>
              </div>
            </crm-form-section>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TinyMce from "../../_common/tinymce";
import { defaultDay } from "../helpers";

export default {
  name: "ItineraryForm",
  components: { TinyMce },
  props: {
    form: {
      type: Object,
      required: true,
    },
  },
  methods: {
    addDay() {
      this.form.days.push(defaultDay());
    },
    removeDay(dayIndex) {
      this.form.days.splice(dayIndex, 1);
    },
  },
};
</script>

<style scoped>
.itinerary-day-item {
  border: 1px dashed #ddd;
  border-radius: 8px;
  padding: 12px;
  margin-bottom: 12px;
  background: #fafafa;
}

.itinerary-day-item__remove {
  cursor: pointer;
  margin: 0;
  color: #e55;
}
</style>
