<template>
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalSearch">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Search {{ title }}</h3>
				</div>
				<div class="modal-body">
					<input
						class="form-control"
						placeholder="search" 
						v-model="searchToken"
						@keyup="loadSearch"
						autofocus
					>
					<div class="list-group">
						<div v-for="item in searchItems" :key="item.id">
							<router-link data-dismiss="modal" class="list-group-item" :to="`${url}/${item.id}`">
								<div class="row">
									<div v-for="col in searchFields" :key="col.field">
										<div :class="col.class">
											<strong class="text-left">{{ item[col.field] }}</strong>
										</div>
									</div>
								</div>
							</router-link>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import toastr from 'toastr'
	import { get } from '../helpers/api'
	
	export default {
		data() {
			return {
				searchToken: '',
				searchItems: []
			}
		},
		props: {
			title: {
			    type: String,
			    default: null
            },
			resource: {
			    type: String,
			    default: null
            },
			url: {
				type: String,
				default: null
			},
			searchFields: {
				type: Array,
				default: null
			}
		},
		methods: {
			loadSearch () {
				get(`/api/${this.$props.resource}/search?q=${this.searchToken}`)
					.then((res) => {
						this.searchItems = res.data.data
					})
					.catch((e) => {
						toastr.error(e.message)
					} )
			},
		}
	}
</script>
