package app.nisb.easykey

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import kotlinx.android.synthetic.main.activity_login.*
import java.security.MessageDigest


class LoginActivity : AppCompatActivity() {
         override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)
        blog1.setOnClickListener{view ->
            val intent = Intent(this, MainActivity::class.java)
            intent.putExtra("email", email1.text.toString())
            intent.putExtra("pass", pass1.text.toString())
            startActivity(intent)
            //finish()
        }
    }
}
