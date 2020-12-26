import 'dart:convert';
import 'package:http/http.dart'
    as http; 
import 'kategori.dart';
import 'post.dart';
import 'komentar.dart';
class Services {
  static const ROOT = 'http://192.168.0.132//kuliah/WebDinamis/function/services.php'; 


  static Future<List<Post>> getPost() async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_POST';
      final response = await http.post(ROOT, body: map);
      print('getpost Response: ${response.body}');
      if (200 == response.statusCode) {
        List<Post> list = parseResponse(response.body);
        return list;
      } else {
        return List<Post>();
      }
    } catch (e) {
      print(e);
      return List<Post>(); // return an empty list on exception/error
    }
  }

  static Future<List<Kategori>> getKategori() async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_KATEGORI';
      final response = await http.post(ROOT, body: map);
      print('getkategori Response: ${response.body}');
      if (200 == response.statusCode) {
        final parsed = json.decode(response.body).cast<Map<String, dynamic>>();
        List<Kategori> list = parsed.map<Kategori>((json) => Kategori.fromJson(json)).toList();
        return list;
      } else {
        return List<Kategori>();
      }
    } catch (e) {
      print(e);
      return List<Kategori>(); // return an empty list on exception/error
    }
  }

  static Future<List<Post>> getPostByKeyword(String keyword) async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_POST_KEYWORD';
      map['keyword'] = keyword;
      final response = await http.post(ROOT, body: map);
      print('getpost Response: ${response.body}');
      if (200 == response.statusCode) {
        List<Post> list = parseResponse(response.body);
        return list;
      } else {
        return List<Post>();
      }
    } catch (e) {
      print(e);
      return List<Post>(); // return an empty list on exception/error
    }
  }

  static Future<List<Post>> getPostByKategori(String idkategori) async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_POST_KEYWORD';
      map['idkategori'] = idkategori;
      final response = await http.post(ROOT, body: map);
      print('getpost Response: ${response.body}');
      if (200 == response.statusCode) {
        List<Post> list = parseResponse(response.body);
        return list;
      } else {
        return List<Post>();
      }
    } catch (e) {
      print(e);
      return List<Post>(); // return an empty list on exception/error
    }
  }

  static Future<String> getNamaPenulis(String idpenulis) async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_NAMA_PENULIS';
      map['idpenulis'] = idpenulis;
      final response = await http.post(ROOT, body: map);
      print('getnamapenulis Response: ${response.body}');
      if (200 == response.statusCode) {
        final penulis = jsonDecode(response.body);
        print('getnamapenulis Response: ${penulis[0]['nama']}');
        return penulis[0]['nama'];
      } else {
        return '';
      }
    } catch (e) {
      print(e);
      return ''; // return an empty list on exception/error
    }
  }
static Future<List<Komentar>> getKomentar(String idpost) async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_KOMENTAR';
      map['idpost'] = idpost;
      final response = await http.post(ROOT, body: map);
      print('getKomentar Response: ${response.body}');
      if (200 == response.statusCode) {
        if(response.body == 'error'){
          return List<Komentar>();
        }
        final parsed = json.decode(response.body).cast<Map<String, dynamic>>();
        List<Komentar> list = parsed.map<Komentar>((json) => Komentar.fromJson(json)).toList();
        return list;
      } else {
        return List<Komentar>();
      }
    } catch (e) {
      print(e);
      return List<Komentar>(); // return an empty list on exception/error
    }
  }

  static List<Post> parseResponse(String responseBody) {
    final parsed = json.decode(responseBody).cast<Map<String, dynamic>>();
    return parsed.map<Post>((json) => Post.fromJson(json)).toList();
  }
  

}