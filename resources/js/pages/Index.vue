<template>
  <div class="dashboard-container py-8">
    <!-- Tombol Kembali Melayang -->
    <button @click="$router.back()" class="btn-kembali-fixed">Kembali</button>
    <!-- Informasi Personal -->
    <div class="form-biodata mb-8">
      <h2 class="text-lg font-bold mb-4 text-green-700">Informasi Personal</h2>
      <div class="flex flex-col items-center mb-6">
        <img
          v-if="biodata.foto"
          :src="'/storage/' + biodata.foto"
          alt="Foto"
          class="foto-box mb-4"
        />
        <div class="w-full max-w-md data-table">
          <div class="mb-2"><span class="label">Nama:</span><span class="value">{{ biodata.nama }}</span></div>
          <div class="mb-2"><span class="label">Universitas:</span><span class="value">{{ biodata.universitas }}</span></div>
          <div class="mb-2"><span class="label">Summary:</span><span class="value">{{ biodata.summary }}</span></div>
        </div>
      </div>
    </div>
    <!-- Pengalaman -->
    <div class="form-biodata">
      <h2 class="text-lg font-bold mb-4 text-green-700">Pengalaman</h2>
      <div v-if="biodata.link_tautan && Object.keys(biodata.link_tautan).length" class="mb-4">
        <label class="block text-sm font-medium mb-1">Link Tautan</label>
        <div class="flex flex-wrap gap-2">
          <a v-for="(url, key) in biodata.link_tautan" :key="key" :href="url" target="_blank" class="text-blue-600 underline text-sm">{{ key }}</a>
        </div>
      </div>
      <div v-if="biodata.organizational_experience && biodata.organizational_experience.length" class="mb-4">
        <label class="block text-sm font-medium mb-1">Organizational Experience</label>
        <ul class="list-disc ml-5">
          <li v-for="(org, i) in biodata.organizational_experience" :key="i">
            <b>{{ org.posisi }}</b> ({{ org.tahun }}) - {{ org.organisasi }}, {{ org.lokasi }}<br>
            <span>{{ org.penjelasan }}</span>
          </li>
        </ul>
      </div>
      <div v-if="biodata.volunteer_experience && biodata.volunteer_experience.length" class="mb-4">
        <label class="block text-sm font-medium mb-1">Volunteer Experience</label>
        <ul class="list-disc ml-5">
          <li v-for="(vol, i) in biodata.volunteer_experience" :key="i">
            <b>{{ vol.posisi }}</b> ({{ vol.tahun }}) - {{ vol.acara }}, {{ vol.lokasi }}<br>
            <span>{{ vol.penjelasan }}</span>
          </li>
        </ul>
      </div>
      <div v-if="biodata.education && biodata.education.length" class="mb-4">
        <label class="block text-sm font-medium mb-1">Education</label>
        <ul class="list-disc ml-5">
          <li v-for="(edu, i) in biodata.education" :key="i">
            <b>{{ edu.universitas }}</b> ({{ edu.tahun_masuk }} - {{ edu.tahun_keluar }}) - {{ edu.lokasi }}<br>
            <span>{{ edu.penjelasan }}</span>
          </li>
        </ul>
      </div>
      <div v-if="biodata.achievement && biodata.achievement.length" class="mb-4">
        <label class="block text-sm font-medium mb-1">Achievement</label>
        <ul class="list-disc ml-5">
          <li v-for="(ach, i) in biodata.achievement" :key="i">
            <b>{{ ach.judul }}</b>: {{ ach.penjelasan }}
          </li>
        </ul>
      </div>
      <div v-if="biodata.additional_information" class="mb-2">
        <label class="block text-sm font-medium mb-1">Additional Information</label>
        <p>{{ biodata.additional_information }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const biodata = ref({})

onMounted(async () => {
  const res = await axios.get(`/api/biodata/${route.params.id}`)
  biodata.value = res.data
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap');
:global(body) {
  background: #f9f9f9 !important;
}
.dashboard-container {
  font-family: 'Roboto', Arial, Helvetica, sans-serif;
  background: transparent;
  min-height: 100vh;
  position: relative;
}
.form-biodata {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  padding: 24px;
  max-width: 700px;
  margin-right: auto;
  margin-left: auto;
  margin-bottom: 24px;
}
.form-biodata.mb-8 {
  margin-top: 20px;
}
.foto-box {
  width: 100%;
  max-width: 220px;
  height: auto;
  max-height: 220px;
  object-fit: cover;
  border-radius: 10px;
  border: 2px solid #27c04d;
  background: #f3f3f3;
  display: block;
}
.btn-kembali-fixed {
  position: fixed;
  top: 24px;
  left: 10px;
  z-index: 50;
  background: #27c04d;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 10px 14px;
  font-size: 12px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.2s;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}
.btn-kembali-fixed:hover {
  background: #21943b;
}
.data-table {
  padding-top: 10px;
}
.data-table .label {
  display: inline-block;
  min-width: 110px; /* atur sesuai kebutuhan */
  font-weight: 600;
}
.data-table .value {
  display: inline-block;
  margin-left: 16px;
  word-break: break-word;
}
</style>
