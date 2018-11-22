<?php

return [
    'account' => [
        'current_password' => 'Mevcut Şifre',
        'delete_user' => 'Kullanıcıyı Sil',
        'details_updated' => 'Hesap ayarlarınız başarıyla güncellendi.',
        'exception' => 'Hesabınız güncellenirken bir hata oluştu.',
        'first_name' => 'İsim',
        'header' => 'HESAP AYARLARI',
        'header_sub' => 'Hesap ayarlarınızı düzenleyin.',
        'invalid_password' => 'Girdiğiniz şifre doğru değil.',
        'last_name' => 'Soy İsim',
        'new_email' => 'Yeni Eposta Adresi',
        'new_password' => 'Yeni Şifre',
        'new_password_again' => 'Tekrar Yeni Şifre',
        'totp_disable' => '2-Aşamalı Doğrulamayı Devre Dışı Bırak',
        'totp_enable' => '2-Aşamalı Doğrulamayı Etkinleştir',
        'totp_enabled_error' => 'Tek seferlik doğrulama kodunuz yanlış. Lütfen sonra tekrar deneyin.',
        'totp_enable_help' => 'Görünüşe göre 2-Aşamalı doğrulama devre dışı. Bu doğrulama metodu, hesabınıza yetkisiz girişleri engellemek için ek bir önlem oluşturur. Eğer etkinleştirirseniz, hesabınıza bağlanırken telefonunuzda veya tek seferlik doğrulama kodu destekleyen bir cihazda oluşturulan kodu girmeniz gerekecektir.',
        'update_email' => 'Güncelle',
        'update_identitity' => 'Güncelle',
        'update_pass' => 'Güncelle',
        'update_user' => 'Güncelle',
        'username_help' => 'Kullanıcı adınız hesabınıza özgün olmalı ve belirtilen karakterleri barındırmalıdır. :requirements.',
    ],
    'api' => [
        'index' => [
            'create_new' => 'Yeni Yetki Oluştur',
            'header' => 'Yetki Paylaşımı',
            'header_sub' => 'Yetki anahtarlarınızı düzenleyin',
            'keypair_created' => 'Yetki Anahtarı başarıyla oluşturuldu ve listelendi.',
            'list' => 'Yetki Anahtarlarınız',
        ],
        'new' => [
            'allowed_ips' => [
                'description' => 'Enter a line delimitated list of IPs that are allowed to access the API using this key. CIDR notation is allowed. Leave blank to allow any IP.',
                'title' => 'Allowed IPs',
            ],
            'base' => [
                'information' => [
                    'title' => 'Ana Bilgileri Görüntüleme',
                ],
                'title' => 'Ana Bilgiler',
            ],
            'descriptive_memo' => [
                'description' => 'Enter a brief description of this key that will be useful for reference.',
                'title' => 'Description',
            ],
            'form_title' => 'Details',
            'header' => 'Yeni Yetki Anahtarı',
            'header_sub' => 'Create a new account access key.',
            'location_management' => [
                'list' => [
                    'title' => 'Lokasyonları listele',
                ],
                'title' => 'Lokasyon yönetimi',
            ],
            'server_management' => [
                'config' => [
                    'title' => 'Konfigürasyon Güncelleme',
                ],
                'create' => [
                    'title' => 'Sunucu Oluşturma',
                ],
                'delete' => [
                    'title' => 'Sunucuyu Silme',
                ],
                'list' => [
                    'title' => 'Sunucuları Listeleme',
                ],
                'server' => [
                    'title' => 'Sunucu Bilgisi',
                ],
                'title' => 'Sunucu Yönetimi',
            ],
            'service_management' => [
                'title' => 'Servis Yönetimi',
            ],
            'user_management' => [
                'create' => [
                    'description' => 'Sistemde yeni bir kullanıcı oluşturulmasına izin verir.',
                    'title' => 'Kullanıcı Oluşturma',
                ],
                'delete' => [
                    'title' => 'Kullanıcı Silme',
                ],
                'list' => [
                    'description' => 'Sistemdeki kullanıcıların listelenmesine izin verir.',
                    'title' => 'Kullanıcıları Listeleme',
                ],
                'title' => 'Kullanıcı Yönetimi',
                'update' => [
                    'description' => 'Kullanıcı detaylarının değiştirilmesini sağlar. (E-posta, şifre)',
                    'title' => 'Kullanıcı Güncelleme',
                ],
            ],
        ],
    ],
    'confirm' => 'Emin misin?',
    'errors' => [
        '403' => [
            'desc' => 'Bu sunucudaki kaynaklara ulaşma yetkiniz yok.',
            'header' => 'Yasak',
        ],
        '404' => [
            'desc' => 'İstenilen dosya sunucuda bulunamadı.',
            'header' => 'Dosya Bulunamadı',
        ],
        'home' => 'Anasayfaya Dön',
        'installing' => [
            'desc' => 'Sunucu hala yüklenme aşamasında. Biraz sonra tekrar deneyin.',
            'header' => 'Sunucu Yükleniyor',
        ],
        'return' => 'Önceki Sayfaya Dön',
        'suspended' => [
            'desc' => 'Bu sunucu erişime kapatıldı.',
            'header' => 'Sunucu Askıya Alındı',
        ],
    ],
    'form_error' => 'Bu isteği işlerken aşağıdaki hatayi karşılaşıldı.',
    'index' => [
        'header' => 'Sunucularınız',
        'header_sub' => 'Erişiminiz bulunan sunucular.',
        'list' => 'Sunucu Listesi',
    ],
    'security' => [
        '2fa_checkpoint_help' => 'Telefonunuzdaki 2AD uygulaması ile soldaki QR kodunun resmini çekin, ya da altındaki kodu elle uygulamaya girin. Bu işlemi yaptıktan sonra, uygulamanın ürettiği tokeni aşağıya girin.',
        '2fa_disabled' => '2-Aşamalı Doğrulama (2AD) devre dışı! Hesap güvenliğiniz için 2AD\'yi etkinleştirmelisiniz.',
        '2fa_disable_error' => 'Girilen 2AD kodu geçersiz. Koruma bu hesap için devre dışı bırakılmadı.',
        '2fa_enabled' => 'Bu hesapta 2-Aşamalı Doğrulama (2AD) etkin ve panele giriş için zorunludur. 2AD\'yi iptal etmek istiyorsanız, aşağıya geçerli bir 2AD kodu girin ve göndere tıklayın.',
        '2fa_header' => '2-Aşamalı Doğrulama',
        '2fa_qr' => 'Cihazınızda 2-Aşamalı Doğrulama Ayarlayın',
        '2fa_token_help' => 'Uygulamanız tarafından oluşturulan 2AD kodunuzu girin (Google Doğrulama, Authy, vs.).',
        'disable_2fa' => '2-Aşamalı Doğrulamayı Devre Dışı Bırak',
        'enable_2fa' => '2-Aşamalı Doğrulamayı Etkinleştir',
        'header' => 'Hesap Güvenliği',
        'header_sub' => 'Aktif oturum ve iki aşamalı doğrulama (2AD) yönetimi.',
        'loading_qr' => 'QR Kodu Yükleniyor...',
        'sessions' => 'Aktif Oturumlar',
        'session_mgmt_disabled' => 'Kullanıcı oturumları yönetimi özelliği kapalı durumda.',
    ],
    'server_name' => 'Sunucu Adı',
    'validation_error' => 'İstekte gönderilen bir ya da birden fazla alan ile ilgili hata oluştu.',
    'view_as_admin' => 'Sunucu listesini yönetici olarak görüyorsunuz. Bu sebeple, sistemde kurulu bütün sunucular gösteriliyor. Size ait olarak belirlenmiş sunucular, isimlerinin solunda mavi bir nokta ile işaretlendi.',
];
