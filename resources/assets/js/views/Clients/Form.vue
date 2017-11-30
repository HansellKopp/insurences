<template>
	<div class="client-show">
		<div class="client-header">
			<h3>{{action}} client</h3>
			<div>
				<button class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
				<button class="btn" @click="$router.back()" :disabled="isProcessing">Cancel</button>
			</div>
		</div>
		<div class="client-row">
			<div class="client-image">
				<div class="client-box">
					<image-upload v-model="form.image"></image-upload>
					<small class="error-control" v-if="error.image">{{error.image[0]}}</small>
				</div>
			</div>
			<div class="client-details">
				<div class="client-details_inner">
					<div class="form-group">
					    <label>Name</label>
					    <input type="text" class="form-control" v-model="form.name">
					    <small class="error-control" v-if="error.name">{{error.name[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Description</label>
					    <textarea class="form-control form-description" v-model="form.description"></textarea>
					    <small class="error-control" v-if="error.description">{{error.description[0]}}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import { get, post } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import ImageUpload from '../../components/ImageUpload.vue'

	export default {
		components: {
			ImageUpload
		},
		data() {
			return {
				form: {
					ingredients: [],
					directions: []
				},
				error: {},
				isProcessing: false,
				initializeURL: `/api/clients/create`,
				storeURL: `/api/clients`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/clients/${this.$route.params.id}/edit`
				this.storeURL = `/api/clients/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				})
		},
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
							tostsr.success(res.data.message)
				            this.$router.push(`/clients/${res.data.id}`)
				        }
				        this.isProcessing = false
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				        }
				        this.isProcessing = false
				    })
			},
			addDirection() {
				this.form.directions.push({
					description: ''
				})
			},
			addIngredient() {
				this.form.ingredients.push({
					name: '',
					qty: ''
				})
			},
			remove(type, index) {
				if(this.form[type].length > 1) {
					this.form[type].splice(index, 1)
				}
			}
		}
	}
</script>
