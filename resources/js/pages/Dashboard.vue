<template>
  <div class="dashboard-container">
    <div class="tabs">
      <button @click="activeTab = 'list'" :class="['tab-button', { active: activeTab === 'list' }]">Daftar Biodata</button>
      <button @click="activeTab = 'form'" :class="['tab-button', { active: activeTab === 'form' }]">Tambah Biodata</button>
    </div>

    <!-- List Biodata -->
    <div v-if="activeTab === 'list'">
      <div class="space-y-4">
        <div
          v-for="bio in biodata"
          :key="bio.id"
          class="card-biodata flex items-center gap-4 cursor-pointer hover:bg-gray-50 transition"
          @click="goToDetail(bio.id)"
        >
          <!-- Foto kiri -->
          <img :src="'/storage/' + bio.foto" alt="Foto" class="biodata-foto" />
          <!-- Info tengah -->
          <div class="flex-1 ml-5">
            <div class="biodata-nama">{{ bio.nama }}</div>
            <div class="biodata-universitas">{{ bio.universitas }}</div>
          </div>
          <!-- Tombol kanan -->
          <div class="flex flex-col gap-2 ml-auto">
            <button @click.stop="editBiodata(bio)" class="btn-tambah w-20">Edit</button>
            <button @click.stop="deleteBiodata(bio.id)" class="btn-hapus w-20">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Biodata -->
    <div v-else>
      <form @submit.prevent="submitForm" class="space-y-8">
        <!-- Informasi Personal -->
        <div class="form-biodata">
          <h2 class="text-lg font-bold mb-4 text-green-700">Informasi Personal</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Nama</label>
              <input v-model="form.nama" placeholder="Nama" class="w-full p-2 border rounded" required />
            </div>
            <div>
              <label class="block text-sm font-medium">Universitas</label>
              <input v-model="form.universitas" placeholder="Universitas" class="w-full p-2 border rounded" />
            </div>
            <div>
              <label class="block text-sm font-medium">Foto (JPG)</label>
              <input type="file" accept="image/jpeg" @change="handleFoto" class="w-full p-2 border rounded" />
            </div>
            <div>
              <label class="block text-sm font-medium">Summary</label>
              <textarea v-model="form.summary" placeholder="Ringkasan" class="w-full p-2 border rounded" />
            </div>
          </div>
        </div>
        <!-- Pengalaman -->
        <div class="form-biodata">
          <h2 class="text-lg font-bold mb-4 text-green-700">Pengalaman</h2>
          <div>
            <label class="block text-sm font-medium">Link Tautan</label>
            <div class="flex gap-2 mb-2" v-for="(item, idx) in form.link_tautan" :key="idx">
              <input v-model="item.key" placeholder="Tipe (LinkedIn, GitHub, ...)" class="p-2 border rounded w-1/3" />
              <input v-model="item.value" placeholder="URL" class="p-2 border rounded w-2/3" />
              <button type="button" @click="removeLink(idx)" class="btn-hapus col-span-5">Hapus</button>
            </div>
            <button type="button" @click="addLink" class="btn-tambah">+ Tambah Link</button>
          </div>
          <div>
            <label class="block text-sm font-medium">Organizational Experience</label>
            <div v-for="(org, idx) in form.organizational_experience" :key="idx" class="grid grid-cols-5 gap-2 mb-2">
              <input v-model="org.posisi" placeholder="Posisi" class="p-2 border rounded" />
              <input v-model="org.organisasi" placeholder="Organisasi" class="p-2 border rounded" />
              <input v-model="org.tahun" placeholder="Tahun" class="p-2 border rounded" />
              <input v-model="org.lokasi" placeholder="Lokasi" class="p-2 border rounded" />
              <textarea v-model="org.penjelasan" placeholder="Penjelasan" class="p-2 border rounded auto-textarea" rows="2" />
              <button type="button" @click="removeOrg(idx)" class="btn-hapus col-span-5">Hapus</button>
            </div>
            <button type="button" @click="addOrg" class="btn-tambah">+ Tambah Pengalaman Organisasi</button>
          </div>
          <div>
            <label class="block text-sm font-medium">Volunteer Experience</label>
            <div v-for="(vol, idx) in form.volunteer_experience" :key="idx" class="grid grid-cols-5 gap-2 mb-2">
              <input v-model="vol.posisi" placeholder="Posisi" class="p-2 border rounded" />
              <input v-model="vol.acara" placeholder="Acara" class="p-2 border rounded" />
              <input v-model="vol.tahun" placeholder="Tahun" class="p-2 border rounded" />
              <input v-model="vol.lokasi" placeholder="Lokasi" class="p-2 border rounded" />
              <textarea v-model="vol.penjelasan" placeholder="Penjelasan" class="p-2 border rounded auto-textarea" rows="2" />
              <button type="button" @click="removeVol(idx)" class="btn-hapus col-span-5">Hapus</button>
            </div>
            <button type="button" @click="addVol" class="btn-tambah">+ Tambah Volunteer</button>
          </div>
          <div>
            <label class="block text-sm font-medium">Education</label>
            <div v-for="(edu, idx) in form.education" :key="idx" class="grid grid-cols-5 gap-2 mb-2">
              <input v-model="edu.universitas" placeholder="Universitas" class="p-2 border rounded" />
              <input v-model="edu.tahun_masuk" placeholder="Tahun Masuk" class="p-2 border rounded" />
              <input v-model="edu.tahun_keluar" placeholder="Tahun Keluar" class="p-2 border rounded" />
              <input v-model="edu.lokasi" placeholder="Lokasi" class="p-2 border rounded" />
              <textarea v-model="edu.penjelasan" placeholder="Penjelasan" class="p-2 border rounded auto-textarea" rows="2" />
              <button type="button" @click="removeEdu(idx)" class="btn-hapus col-span-5">Hapus</button>
            </div>
            <button type="button" @click="addEdu" class="btn-tambah">+ Tambah Pendidikan</button>
          </div>
          <div>
            <label class="block text-sm font-medium">Achievement</label>
            <div v-for="(ach, idx) in form.achievement" :key="idx" class="grid grid-cols-2 gap-2 mb-2">
              <input v-model="ach.judul" placeholder="Judul/Nama Acara" class="p-2 border rounded" />
              <textarea v-model="ach.penjelasan" placeholder="Penjelasan" class="p-2 border rounded auto-textarea" rows="2" />
              <button type="button" @click="removeAch(idx)" class="btn-hapus col-span-2">Hapus</button>
            </div>
            <button type="button" @click="addAch" class="btn-tambah">+ Tambah Prestasi</button>
          </div>
          <div>
            <label class="block text-sm font-medium">Additional Information</label>
            <textarea v-model="form.additional_information" placeholder="Informasi tambahan" class="w-full p-2 border rounded" />
          </div>
          <div class="flex justify-end mt-6">
            <button type="submit" class="btn-tambah">
              {{ editingId ? 'Update' : 'Simpan' }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const activeTab = ref('list')
const biodata = ref([])
const editingId = ref(null)

const form = ref({
  nama: '',
  universitas: '',
  summary: '',
  foto: null,
  link_tautan: [],
  organizational_experience: [],
  volunteer_experience: [],
  education: [],
  achievement: [],
  additional_information: '',
})

// Helper for dynamic fields
const addLink = () => form.value.link_tautan.push({ key: '', value: '' })
const removeLink = idx => form.value.link_tautan.splice(idx, 1)
const addOrg = () => form.value.organizational_experience.push({ posisi: '', organisasi: '', tahun: '', lokasi: '', penjelasan: '' })
const removeOrg = idx => form.value.organizational_experience.splice(idx, 1)
const addVol = () => form.value.volunteer_experience.push({ posisi: '', acara: '', tahun: '', lokasi: '', penjelasan: '' })
const removeVol = idx => form.value.volunteer_experience.splice(idx, 1)
const addEdu = () => form.value.education.push({ universitas: '', tahun_masuk: '', tahun_keluar: '', lokasi: '', penjelasan: '' })
const removeEdu = idx => form.value.education.splice(idx, 1)
const addAch = () => form.value.achievement.push({ judul: '', penjelasan: '' })
const removeAch = idx => form.value.achievement.splice(idx, 1)

const getBiodata = async () => {
  const res = await axios.get('/api/biodata')
  biodata.value = res.data
}

const handleFoto = (e) => {
  form.value.foto = e.target.files[0]
}

const submitForm = async () => {
  const payload = new FormData()
  for (const key in form.value) {
    if (key === 'link_tautan') {
      // Convert array of {key, value} to object
      const obj = {}
      form.value.link_tautan.forEach(item => {
        if (item.key && item.value) obj[item.key] = item.value
      })
      payload.append('link_tautan', JSON.stringify(obj))
    } else if (
      key === 'organizational_experience' ||
      key === 'volunteer_experience' ||
      key === 'education' ||
      key === 'achievement'
    ) {
      payload.append(key, JSON.stringify(form.value[key]))
    } else if (key === 'foto') {
      if (form.value.foto) payload.append('foto', form.value.foto)
    } else {
      payload.append(key, form.value[key])
    }
  }

  if (editingId.value) {
    await axios.post(`http://localhost:8000/api/biodata${editingId.value}?_method=PUT`, payload, {
      headers: { 'Content-Type': 'multipart/form-data' }
    })
  } else {
    await axios.post('/api/biodata', payload, {
      headers: { 'Content-Type': 'multipart/form-data' }
    })
  }

  resetForm()
  await getBiodata()
  activeTab.value = 'list'
}

const resetForm = () => {
  form.value = {
    nama: '',
    universitas: '',
    summary: '',
    foto: null,
    link_tautan: [],
    organizational_experience: [],
    volunteer_experience: [],
    education: [],
    achievement: [],
    additional_information: '',
  }
  editingId.value = null
}

const editBiodata = (bio) => {
  form.value = {
    nama: bio.nama,
    universitas: bio.universitas,
    summary: bio.summary,
    foto: null,
    link_tautan: Object.entries(bio.link_tautan || {}).map(([key, value]) => ({ key, value })),
    organizational_experience: bio.organizational_experience ? JSON.parse(JSON.stringify(bio.organizational_experience)) : [],
    volunteer_experience: bio.volunteer_experience ? JSON.parse(JSON.stringify(bio.volunteer_experience)) : [],
    education: bio.education ? JSON.parse(JSON.stringify(bio.education)) : [],
    achievement: bio.achievement ? JSON.parse(JSON.stringify(bio.achievement)) : [],
    additional_information: bio.additional_information,
  }
  editingId.value = bio.id
  activeTab.value = 'form'
}

const deleteBiodata = async (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    await axios.delete(`/api/biodata/${id}`)
    await getBiodata()
  }
}

const goToDetail = (id) => {
  router.push({ name: 'biodata-detail', params: { id } })
}

onMounted(() => getBiodata())
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap');

.dashboard-container {
  font-family: 'Roboto', Arial, Helvetica, sans-serif;
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 8px;
  min-height: calc(100vh - 64px);
  padding: 24px;
  max-width: 100%;
}

.tabs {
  display: flex;
  border-bottom: 2px solid #cbc8c8;
  margin-bottom: 16px;
  gap: 8px;
}

.tab-button {
  padding: 8px 18px;
  background: none;
  border: none;
  border-bottom: 3px solid transparent;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
  color: #000;
  transition: all 0.2s;
  font-family: inherit;
}

.tab-button.active,
.tab-button:focus {
  border-bottom: 3px solid #27c04d;
  color: #27c04d;
  background: #f0f4f8;
  font-family: inherit;
}

.tab-button:hover {
  background-color: #e5e5e5;
}

.grid {
  gap: 24px;
}

.card-biodata {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  padding: 16px 20px;
  display: flex;
  margin-bottom: 10px;
  align-items: center;
  min-height: 100px;
  font-family: 'Roboto', Arial, Helvetica, sans-serif;
  position: relative;
}

.biodata-foto {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  border: 3px solid #27c04d;
  background: #f3f3f3;
  flex-shrink: 0;
}

.flex-1.ml-5 {
  margin-left: 20px !important;
}

.card-biodata .ml-auto {
  margin-left: auto !important;
}

.biodata-nama {
  font-size: 1.1rem;
  font-weight: bold;
  color: #222;
  margin-bottom: 4px;
  font-family: 'Roboto', Arial, Helvetica, sans-serif;
}

.biodata-universitas {
  font-size: 1rem;
  color: #444;
  font-family: 'Roboto', Arial, Helvetica, sans-serif;
}

.form-biodata {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  padding: 24px;
  max-width: 700px;
  margin-right: auto;
  margin-left: auto;
  margin-top: 10px;
  font-family: inherit;
}

.form-biodata label {
  font-weight: 500;
  color: #222;
  margin-bottom: 4px;
  display: block;
  font-family: inherit;
}

.form-biodata input,
.form-biodata textarea {
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 8px;
  width: 98%;
  margin-bottom: 8px;
  font-size: 14px;
  background: #f9f9f9;
  transition: border 0.2s;
  font-family: inherit;
}

.form-biodata textarea,
.form-biodata .auto-textarea {
  min-height: 38px;
  resize: vertical;
  overflow-y: auto;
}

.form-biodata input:focus,
.form-biodata textarea:focus {
  border: 1.5px solid #27c04d;
  outline: none;
  background: #fff;
}

.form-biodata .flex {
  gap: 8px;
}

.form-biodata button[type="button"].btn-hapus {
  background: #e74c3c;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 5px 10px;
  font-size: 15px;
  cursor: pointer;
  margin-left: 4px;
  margin-bottom: 10px;
  font-weight: bold;
  transition: background 0.2s;
}

.form-biodata button[type="button"].btn-hapus:hover {
  background: #c0392b;
}

.form-biodata .btn-tambah {
  background: #27c04d;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 5px 10px;
  font-size: 12px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 20px;
  transition: background 0.2s;
  display: inline-block;
}

.form-biodata .btn-tambah:hover {
  background: #21943b;
}

.form-biodata button[type="submit"] {
  background: #27c04d;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 12px 28px;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.2s;
  font-family: inherit;
}

.form-biodata button[type="submit"]:hover {
  background: #21943b;
}

@media (max-width: 768px) {
  .dashboard-container,
  .form-biodata {
    padding: 10px;
  }
  .grid {
    gap: 12px;
  }
  .form-biodata input,
  .form-biodata textarea {
    font-size: 13px;
    padding: 6px;
  }
  .form-biodata {
    max-width: 100%;
  }
}
</style>
