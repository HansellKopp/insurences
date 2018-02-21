<template>
	<list-view
		title="Branches"
		url="/branches"
		resource="branches"
		:searchFields="searchFields"
		:listRows="listRows"
		:sortBy="name"
	/>
</template>

<script>
import listView from '../../components/listView'

export default {
  	components: {
		listView
	},
	data() {
		return {
			sortBy: 'name',
			searchFields: [
				{ 'field': 'name', 'class': 'col-xs-10'},
			],
			listRows: [
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'name', 'class': 'col-xs-5'}
						]
					}
			],
		}
	}
}
</script>
