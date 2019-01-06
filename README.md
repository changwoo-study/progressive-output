# Progressive Output

Progressive output 테스트를 위한 워드프레스 플러그인


## 설명

활성화하면 'PO'라고 관리자 화면에서 메뉴가 생성됩니다.

이 메뉴에서 간단하게 점진적인 출력을 테스트하는 AJAX 코드 예제를 확인할 수 있습니다.

## 핵심 요점
* Javascript
  * jQuery.ajax 메소드 'xhrFields' 옵션
  * xhrFields 옵션에서 'onprogress' 콜백
  * onprogress 콜백 응답에서 이전 메시지 길이 캐치, 현재 메시지 포인트 지점 파악  
* PHP
  * AJAX 응답시 타임 리밋 해제
  * 출력 버퍼링 해제
