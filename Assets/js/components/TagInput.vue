<template>
    <el-form-item :label="label">
        <el-select v-model="tags" multiple filterable allow-create remote default-first-option @change="triggerEvent">
            <el-option v-for="tag in availableTags"
                :key="tag.slug"
                :label="tag.slug"
                :value="tag.name"
            ></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            namespace: { type: String },
            label: { type: String, default: 'Tags' },
            currentTags: { default: null },
        },
        data() {
            return {
                tags: {},
                availableTags: {},
            };
        },
        methods: {
            triggerEvent() {
                this.$emit('input', this.tags);
            },
        },
        watch: {
            currentTags: function () {
                if (this.currentTags !== null) {
                    this.tags = this.currentTags;
                }
            },
        },
        mounted() {
            axios.get(route('api.tag.tag.by-namespace', { namespace: this.namespace }))
                .then(response => {
                    this.availableTags = response.data;
                });
        },
    };
</script>
