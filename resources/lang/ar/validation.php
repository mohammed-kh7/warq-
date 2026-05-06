<?php

return [
    'required' => 'حقل :attribute مطلوب.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالح.',
    'min' => [
        'string' => 'يجب ألا يقل :attribute عن :min حروف.',
        'numeric' => 'يجب ألا يقل :attribute عن :min.',
    ],
    'max' => [
        'string' => 'يجب ألا يزيد :attribute عن :max حروف.',
        'numeric' => 'يجب ألا يزيد :attribute عن :max.',
        'file' => 'يجب ألا يزيد حجم :attribute عن :max كيلوبايت.',
    ],
    'confirmed' => 'كلمة المرور  وتأكيدها غير متطابقين، يرجى التأكد من إدخال نفس الكلمة.',
    'required_with' => 'حقل :attribute مطلوب عند إدخال :values.',
    'unique' => 'هذا :attribute مستخدم بالفعل.',
    'numeric' => 'يجب أن يكون :attribute رقمًا.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'mimes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'regex' => 'يرجى إدخال رقم هاتف صالح.',

    'custom' => [
        'name' => [
            'required' => 'الاسم مطلوب.',
            'string' => 'الاسم يجب أن يكون نصاً.',
            'max' => 'الاسم يجب ألا يزيد عن :max حرف.',
        ],
        'whatsapp' => [
            'required' => 'رقم الواتساب مطلوب.',
            'regex' => 'يرجى إدخال رقم واتساب صالح يحتوي على أرقام فقط ويمكن أن يبدأ بـ +.',
        ],
        'category' => [
            'required' => 'يرجى اختيار الفئة.',
            'in' => 'الفئة المختارة غير صالحة.',
        ],
        'location' => [
            'required' => 'الموقع مطلوب.',
            'string' => 'يرجى إدخال اسم موقع صالح.',
        ],
        'image_path' => [
            'required' => 'الصورة مطلوبة.',
            'image' => 'الملف يجب أن يكون صورة.',
            'mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif.',
            'max' => 'حجم الصورة يجب ألا يتجاوز :max كيلوبايت.',
        ],
        'description' => [
            'required' => 'الوصف مطلوب.',
            'string' => 'الوصف يجب أن يكون نصاً.',
        ],
        'type' => [
            'required' => 'نوع الطلب مطلوب.',
            'string' => 'نوع الطلب يجب أن يكون نصاً.',
        ],
    ],

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'image_path' => 'صورة الكتاب',
        'whatsapp' => 'رقم الواتساب',
        'location' => 'الموقع',
        'description' => 'وصف الكتاب',
        'type' => 'نوع المساعدة',
        'quantity' => 'الكمية',
        'category' => 'الفئة',
    ],
];
