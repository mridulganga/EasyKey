package app.nisb.easykey

import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import com.google.firebase.database.FirebaseDatabase
import kotlinx.android.synthetic.main.activity_main.*
import java.math.BigInteger
import java.security.MessageDigest


class MainActivity : AppCompatActivity() {


    fun String.md5(): String {
        val md = MessageDigest.getInstance("MD5")
        return BigInteger(1, md.digest(toByteArray())).toString(16).padStart(32, '0')
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val database = FirebaseDatabase.getInstance()

        val email = intent.getStringExtra("email") ?: "test"
        email1.text = email
        val myRef = database.getReference("auths").child("test_website").child(email.md5())

        byes.setOnClickListener{view ->
            myRef.setValue("yes")
        }
        bno.setOnClickListener{view ->
            myRef.setValue("no")
        }
    }
}
