<script setup>
import { ref, onMounted, getCurrentInstance, defineExpose } from 'vue';

const app = getCurrentInstance()
const alert = app.appContext.config.globalProperties.$alert;

let align_btns = document.querySelectorAll(".align");
let spacing_btns = document.querySelectorAll(".spacing");
let format_btns = document.querySelectorAll(".format");
let script_btns = document.querySelectorAll(".script");

const fontList = ref([
    "Arial",
    "Verdana",
    "Times New Roman",
    "Garamond",
    "Georgia",
    "Courier New",
    "cursive",
]);

const alignCommands = [
    { command:"justifyLeft", icon:"fa-align-left", className:"option-button align" },
    { command:"justifyCenter", icon:"fa-align-center", className:"option-button align" },
    { command:"justifyRight", icon:"fa-align-right", className:"option-button align" },
    { command:"justifyFull", icon:"fa-align-justify", className:"option-button align" },
]
const spacingCommands = [
    { command:"indent", icon:"fa-indent", className:"option-button spacing" },
    { command:"outdent", icon:"fa-outdent", className:"option-button spacing" },
]
const advanceLinkCommands = [
    { command:"createLink", icon:"fa-link", className:"adv-option-button" },
]
const linkCommands = [
    { command:"unlink", icon:"fa-unlink", className:"option-button" },
]
const basicCommands = [
    { command:"bold", icon:"fa-bold", className:"option-button" },
    { command:"italic", icon:"fa-italic", className:"option-button" },
    { command:"underline", icon:"fa-underline", className:"option-button" },
    { command:"strikethrough", icon:"fa-strikethrough", className:"option-button" },

    { command:"superscript", icon:"fa-superscript", className:"option-button" },
    { command:"subscript", icon:"fa-subscript", className:"option-button" },

    { command:"insertOrderedList", icon:"fa-list-ol", className:"option-button" },
    { command:"insertUnorderedList", icon:"fa-list", className:"option-button" },

    { command:"undo", icon:"fa-undo", className:"option-button" },
    { command:"redo", icon:"fa-redo", className:"option-button" },
]

// clicked button
const highlighter = (className, needsRemoval) => {
    className.forEach((button) => {
        button.addEventListener("click", () => {
            // only one button should be highlight and other would be normal
            if (needsRemoval) {
                let alreadyActive = false;

                // button is already active
                if (button.classList.contains("active")) {
                    alreadyActive = true;
                }

                highlighterRemover(className);
                if (!alreadyActive) {
                    // highlight clicked button
                    button.classList.add("active");
                }
            } else {
                button.classList.toggle("active");
            }
        });
    });
};

// remove highlight
const highlighterRemover = (className) => {
    className.forEach((button) => {
        button.classList.remove("active");
    });
};

// main logic here
const executeCommand = (command, defaultUI=false, parameters=null) => {
    // execCommand executes command on selected text
    /*
        @param commandId — String that specifies the command to execute. 
        This command can be any of the command identifiers that can be executed in script.
        @param showUI — Display the user interface, defaults to false.
        @param value — Value to assign.
    */
    document.execCommand(command, defaultUI, parameters);
};

/*
    isValidUrl is a helper from:
    How to Check if a String is a Valid URL Using Regex
    https://www.freecodecamp.org/news/check-if-a-javascript-string-is-a-url/
*/
const isValidUrl = urlString=> {
    var urlPattern = new RegExp('^(https?:\\/\\/)?'+ // validate protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // validate domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // validate OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // validate port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // validate query string
    '(\\#[-a-z\\d_]*)?$','i'); // validate fragment locator
    return !!urlPattern.test(urlString);
}

const checkUrl = (command) => {
    let userLink = prompt("Enter a valid URL");

    // check if user did not Cancel
    if (userLink != null){ 
        if (!isValidUrl(userLink)){
            alert.toast("Invalid URL!", 'error')
            checkUrl(command);
        }
        executeCommand(command, false, userLink);
    }
}

const getValue = () => {
    return $("#text-input").html();
}

const setValue = (content) => {
    document.getElementById("text-input").innerHTML = content;
}

defineExpose({ getValue, setValue })

onMounted(()=>{
    highlighter(align_btns, true);
    highlighter(spacing_btns, true);
    highlighter(format_btns, false);
    highlighter(script_btns, true);
})
</script>

<template>
    <div class="container">
        <div class="options mx-1 pl-2 py-1 bg-primary">
            <button
                @click="executeCommand(cmd.command)"
                :class="cmd.className"
                :key="`basic_commands_${cmd.command}${index}`"
                v-for="(cmd,index) in basicCommands"
            >
                <i class="fas" :class="cmd.icon"></i>
            </button>
            <button
                @click="checkUrl(cmd.command)"
                :class="cmd.className"
                :key="`basic_commands_${cmd.command}${index}`"
                v-for="(cmd,index) in advanceLinkCommands"
            >
                <i class="fas" :class="cmd.icon"></i>
            </button>
            <button
                @click="executeCommand(cmd.command)"
                :class="cmd.className"
                :key="`basic_commands_${cmd.command}${index}`"
                v-for="(cmd,index) in linkCommands"
            >
                <i class="fas" :class="cmd.icon"></i>
            </button>
            <button
                @click="executeCommand(cmd.command)"
                :class="cmd.className"
                :key="`basic_commands_${cmd.command}${index}`"
                v-for="(cmd,index) in alignCommands"
            >
                <i class="fas" :class="cmd.icon"></i>
            </button>
            <button
                @click="executeCommand(cmd.command)"
                :class="cmd.className"
                :key="`basic_commands_${cmd.command}${index}`"
                v-for="(cmd,index) in spacingCommands"
            >
                <i class="fas" :class="cmd.icon"></i>
            </button>
            
            <select
                id="fontName"
                class="adv-option-button"
                @change="executeCommand('fontName',null,$event.target.value)"
            >
                <option
                    :value="font"
                    v-for="font in fontList"
                    :key="`option_font_${font}`"
                >
                    {{ font }}
                </option>
            </select>
            <select
                id="fontSize"
                class="adv-option-button"
                @change="executeCommand('fontSize',null,$event.target.value)"
            >
                <option
                    :value="size"
                    v-for="size in 20"
                    :key="`option_font_size_${size}`"
                >
                    {{ size }}
                </option>
            </select>
        </div>

        <div id="text-input" contenteditable="true"></div>
    </div>
</template>

<style scoped>
.options {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 15px;
}
button {
    height: 28px;
    width: 28px;
    display: grid;
    place-items: center;
    border-radius: 3px;
    border: none;
    outline: none;
}
select {
    padding: 7px;
    border: 1px solid #224abe;
    border-radius: 3px;
    border: none;
    outline: none;
}
.options label, .options select {
    font-family: "Poppins", sans-serif;
}
.input-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}
input[type="color"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    width: 40px;
    height: 28px;
    border: none;
    cursor: pointer;
}
#text-input {
    margin-top: 10px;
    border: 1px solid #dddddd;
    padding: 20px;
    height: 70vh;
    overflow: auto;
}
.active {
    background-color: #e0e9ff;
}
</style>
