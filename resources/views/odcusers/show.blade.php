<x-app-layout>
    <x-detail-user :odcuser="$odcuser" :odcuserDatas="$odcuserDatas" :activitesP="$activitesP" :activitespAll="$activitespAll"></x-detail-user>

    @section('script')
        <script>
            function showUserCV(event, cvUrl, prenom, nom) {
                event.preventDefault(); // Empêche le lien de se comporter normalement

                // Extraire l'extension du fichier
                const extension = cvUrl.split('.').pop().toLowerCase();

                let content;

                // Vérifiez si l'extension est .pdf
                if (extension === 'pdf') {
                    content = `
                        <iframe src="${cvUrl}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                    `;
                    showSwalForCV(prenom, nom, content);
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    // Si c'est une image, créez une balise img
                    content = `
                        <img src="${cvUrl}" alt="CV de l'utilisateur" style="width: 100%; height: auto;"/>
                    `;
                    showSwalForCV(prenom, nom, content);
                } else {
                    //
                }
            }

            function showSwalForCV(prenom, nom, content) {
                // Affichez le modal avec SweetAlert
                Swal.fire({
                    title: 'CV de  ' + prenom + ' ' + nom,
                    html: content,
                    customClass: {
                        popup: 'bg-gray-800 text-white w-full',
                        confirmButton: 'bg-[#FF7322] text-white rounded px-4 py-2 hover:bg-[#FF7322] focus:outline-none focus:ring focus:ring-[#FF7322]',
                    },
                    showCloseButton: true,
                    confirmButtonText: 'Fermer'
                });
            }
        </script>


        <script>
            $(document).ready(function() {
                $('#participationsTable').css('width', '100%');
                $('.dt-container').addClass('text-lg text-gray-800 dark:text-gray-400 leading-tight')
                $('.dt-buttons').addClass('mt-4')
                $('.dt-buttons buttons').addClass('cursor-pointer mt-5 bg-slate-600 p-2 rounded-sm font-bold')

                $("#dt-length-0").addClass('text-gray-700 dark:text-gray-200 w-24 bg-white');
                $("label[for='dt-length-0']").addClass('text-gray-700 dark:text-gray-200').text(
                    ' Records par page');
                $("label[for='dt-search-0']").addClass('text-gray-700 dark:text-gray-200');
                $('.dt-input').addClass('text-gray-700 dark:text-gray-200');
            });
        </script>
    @endsection
</x-app-layout>
