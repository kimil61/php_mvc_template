// public/js/app.js

function showModal() {
    document.getElementById('modal').classList.remove('hidden');
}

function hideModal() {
    document.getElementById('modal').classList.add('hidden');
}

function confirmDelete() {
    // Perform the delete action
    // Example: document.location.href = '/delete-url';
    hideModal();
}


// 폼 유효성 검사 함수
function validateForm() {
    var email = document.getElementById("email").value;
    if (!email.includes("@")) {
        alert("유효한 이메일 주소를 입력해주세요.");
        return false;  // 폼 제출을 막습니다.
    }
    return true;  // 유효성 검사가 통과되면 폼 제출을 계속합니다.
}

// 이벤트 리스너 추가
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("user_create_form");
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();  // 유효성 검사 실패 시 폼 제출을 막습니다.
        }
    });
});
