<template>
    <draggable v-bind="dragOptions" class="dragArea flex-1" :class="oddOrEven(depth)" tag="div" :list="list" :group="{ name: 'g1' }" itemKey=key>
        <template #item="{ element }">
            <div :key="element.id" class="ListItem flex">
                <div class="ListItem__handle flex flex-none items-center w-6">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15">
                        </path>
                    </svg>
                </div>
                <div class="ListItem__content flex flex-none w-60 items-center">
                    <div class="ListItem__title">
                        {{ element.name }}
                    </div>
                </div>
                <DragableList :list="element.elements" :key=element.id @end="onUpdate(this.list)" :depth="depth+1" />
            </div>
        </template>
    </draggable>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: {
        draggable,
    },
    props: {
        list: {
            type: Array,
            required: true,
            default: []
        },
        key: {
            type: String,
            default: '0'
        },
        depth: {
            type: Number,
            default: 0
        },
        onUpdate: {
            type: Function,
            default: () => {}
        }
    },
    methods: {
        oddOrEven(depth) {
            return depth % 2 ? 'odd' : 'even';
        }
    },
    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: 'description',
                disabled: false,
                ghostClass: 'ghost'
            }
        }
    },
}
</script>
<style scoped>

.dragArea {
    min-height: 50px;
    /* outline: 1px dashed; */
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px 20px;
    margin: 2px 0;

    &.odd {
        background-color: #e3e3e3;
    }

    &.even {
        background-color: #f0f0f0;
    }

    .ListItem {
        background-color: #ffffff;
        border: 1px solid #ccc;
    }

    .ListItem__title {
        color: black;
    }

    .ListItem__handle {
        color: #000000;
    }
}

.dark .dragArea {
    border: 1px solid #2d3748;

    &.odd {
        background-color: #2d3748;
    }

    &.even {
        background-color: #4a5568;
    }

    .ListItem {
        background-color: #485975;
        border: 1px solid #2d3748;
    }

    .ListItem__handle {
        color: #b8b8b8;
    }
    .ListItem__title {
        color: #b8b8b8;
    }
}

.ListItem {
        
        margin: 15px 0!important;
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
    }

    .ListItem__title {
        
        font-size: 1.2rem;
        font-weight: 600;
        padding: 10px 0;
    }

    .ListItem__handle {
        cursor: move;
    }

</style>