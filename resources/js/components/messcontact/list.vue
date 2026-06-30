<template>
  <!-- partial -->
  <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tin nhắn & đăng ký từ website</h4>
              <vs-table max-items="20" pagination :data="list">
                <template slot="thead">
                  <vs-th>ID</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Email</vs-th>
                  <vs-th>Phone</vs-th>
                  <vs-th>Dịch vụ</vs-th>
                  <vs-th>Hải trình</vs-th>
                  <vs-th>Ngày KH</vs-th>
                  <vs-th>Số khách</vs-th>
                  <vs-th>Tin nhắn</vs-th>
                  <vs-th>Thời gian</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">{{ tr.id }}</vs-td>
                    <vs-td :data="tr.name">{{ tr.name || '—' }}</vs-td>
                    <vs-td :data="tr.email">{{ tr.email || '—' }}</vs-td>
                    <vs-td :data="tr.phone">{{ tr.phone || '—' }}</vs-td>
                    <vs-td :data="tr.service_name">{{ tr.service_name || '—' }}</vs-td>
                    <vs-td :data="tr.itinerary">{{ tr.itinerary || '—' }}</vs-td>
                    <vs-td :data="tr.departure_date">{{ formatDate(tr.departure_date) }}</vs-td>
                    <vs-td :data="tr.guest_count">{{ tr.guest_count || '—' }}</vs-td>
                    <vs-td :data="tr.mess">
                      <span class="messcontact-mess">{{ tr.mess || '—' }}</span>
                    </vs-td>
                    <vs-td :data="tr.created_at">{{ formatDateTime(tr.created_at) }}</vs-td>
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
  data: () => ({
    keyword: null,
    popupActivo: false,
    list: [],
    timer:0,
    id_item :''
  }),
  computed: {
    
  },
  methods: {
    ...mapActions(["listMessContact", "loadings"]),
    formatDate(value) {
      if (!value) return '—';
      return String(value).slice(0, 10);
    },
    formatDateTime(value) {
      if (!value) return '—';
      return String(value).replace('T', ' ').slice(0, 16);
    },
    listMessContacts() {
      this.loadings(true);
      this.listMessContact({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
        });
    },
  },
  mounted() {
    this.listMessContacts()
  }
};
</script>
<style>
.messcontact-mess {
  display: inline-block;
  max-width: 280px;
  white-space: pre-wrap;
  word-break: break-word;
}
</style>
